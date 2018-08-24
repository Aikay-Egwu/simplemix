<?php
namespace MVC\Library ;

ob_start();
class Router
{
    protected $url;
    protected $controller;
    protected $action;
    protected $params = null;
    protected $route;
    protected $methodPrefix;
    protected $language;

    public function __construct($uri)
    {
        //echo "<br>Starting the router";
        $this->uri = urldecode(trim($uri, '/'));
        //get defaults routes, array
        $routes              = Config::get('routes');
        $this->route         = Config::get('default_route');
        //$this->methodPrefix = (isset($routes[$this->route])) ? $routes[$this->route] : '';
        $this->methodPrefix = $routes[$this->route] ?? '';
        $this->language      = Config::get('default_language');
        $this->controller    = Config::get('default_controller');
        $this->action        = Config::get('default_action');
        $uri_parts           = explode('?', $this->uri);
        $path                = $uri_parts[0];
        $pathParts          = explode('/', $path);
        //this is used if the applcation is not the application is not
        //going to be run from the web root
        if (ROOT_FOLDER != "") {
            array_shift($pathParts);
        }
        //print_r($pathParts);
        if (count($pathParts)) {
//get router or language at first element
            if (in_array(strtolower(current($pathParts)), array_keys($routes))) {
                $this->route         = strtolower(current($pathParts));
                $this->methodPrefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($pathParts);
            } elseif (in_array(strtolower(current($pathParts)), Config::get('languages'))) {
                $this->language = strtolower(current($pathParts));
                array_shift($pathParts);
            }
            //get the controller, next element of array
            if (current($pathParts)) {
                $this->controller = strtolower(current($pathParts));
                array_shift($pathParts);
            }
//get action
            if (current($pathParts)) {
                $this->action = strtolower(current($pathParts));
                array_shift($pathParts);
            }

            $this->params = $pathParts;
        }
    }

    public static function redirect($uri)
    {
        header("location: " . $uri);
    }
    /**
     * Gets the value of url.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the value of controller.
     *
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Gets the value of action.
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Gets the value of params.
     *
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Gets the value of route.
     *
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Gets the value of method_prefix.
     *
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->methodPrefix;
    }

    /**
     * Gets the value of language.
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
