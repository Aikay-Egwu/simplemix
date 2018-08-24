<?php
namespace MVC\Library ;

class App
{
    protected static $router ;


/**
* Gets the value of router.
*
* @return mixed
*/
    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri)
    {
        
        self::$router = new Router($uri);
        $controllerClass = ucfirst(self::$router->getController());
        $controllerMethod = strtolower(self::$router->getMethodPrefix().self::$router->getAction());
    //check user
        
        $layout = self::$router->getRoute();

        
        if ($layout == 'admin' && Session::get('role') != 'admin') {
            if ($controllerMethod != 'adminlogin') {
                Router::redirect(Path::adminLogin());
            }
        }
        $ns = "MVC\\Controllers\\" ;
        $controls = $ns.$controllerClass ;
        $controllerObject = new $controls();

        if (method_exists($controllerObject, $controllerMethod)) {
            $result = $controllerObject->$controllerMethod();
        } else {
            //this should be a 404 error, do that later
            throw new \Exception(
                'Method '.$controllerMethod .' of '. $controllerClass . ' does not exist'
            );
        }
    }
}
