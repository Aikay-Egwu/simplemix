<?php
namespace MVC\Library ;

//use Lib\Session ;

class View
{
    protected $data;
    protected $path;

    public function __construct($data = array(), $path = null)
    {
        if (!$path) {
            $path = self::getDefaultViewPath();
        } else {
            $path = self::getControllerDir($path);
        }
        //if (!file_exists(VIEWS_PATH . DS . $path)) {
        //    throw new \Exception('Template file is not found in path: ' . $path);
        //}
        $this->path = $path;
        $this->data = $data;
        //$this->twigging();
    }

    /*public function twigging()
    {
        $loader = new Twig_Loader_Filesystem(VIEWS_PATH);
        $twig = new Twig_Environment($loader, array(
        'cache' => CACHE_PATH,
        ));
        var_dump($twig);
    }*/

    /**
     * [getControllerDir description]
     * @param string
     *
     * @return string
     */
    protected static function getControllerDir($path)
    {
        return $path ;
    }


    protected static function getDefaultViewPath()
    {
        $router = App::getRouter();
        if (!$router) {
            return false;
        }
        $controllerDir = $router->getController();
        $templateName  = $router->getMethodPrefix() . $router->getAction() . '.html.twig';
        //$templateName = strtolower($templateName);
        //return VIEWS_PATH . DS . $controllerDir . DS . $templateName;
        return  $controllerDir . DS . $templateName;
        //return  $controllerDir . '.' . $templateName;
    }

    public function render()
    {
        $data = $this->data;
        ob_start();
        include $this->path;
        $content = ob_get_clean();
        return $content;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }
}
