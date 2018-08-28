<?php
namespace MVC\Library ;

use MVC\Library\Router ;
use MVC\Library\Path;

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
        //check for the controller class file
        if (!file_exists(ROOT.'/MVC/Controllers/'.$controllerClass.'.php')) {
            //redirect to 404
            Router::redirect(Path::pageNotFound());
            exit;
        }

        try {
            $controllerObject = new $controls();
        } catch (Exception $e) {
            //echo $e->getMessage();
        }
        

        try {
            if (method_exists($controllerObject, $controllerMethod)) {
                $result = $controllerObject->$controllerMethod();
            }
        } catch (Exception $e) {
        }
         //else {
            //this should be a 404 error, do that later
            //throw new \Exception(
            //    'Method '.$controllerMethod .' of '. $controllerClass . ' does not exist'
            //);
        //}
    }
}
