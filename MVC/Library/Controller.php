<?php
namespace MVC\Library ;

use MVC\Library\View as View;
use MVC\Library\Session as Session ;
use MVC\Library\App ;
use MVC\Library\Path;
use MVC\Classes\Csrf;

//use Lib\Session ;

/**
 *
 */
class Controller
{
    protected $data ;
    protected $model ;
    protected $params ;
    protected $route ;
    protected $action ;

    /**
     * [__construct description]
     * @param array $data [description]
     */
    public function __construct($data = array())
    {
        $this->data = $data ;
        $this->params = App::getRouter()->getParams();
        $this->route = App::getRouter()->getRoute();
        $this->action = App::getRouter()->getAction();
    }

    /**
         * Gets the value of data.
         *
         * @return mixed
         */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Gets the value of model.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
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

    protected function route($file = null)
    {
        $viewObject = new View($this->data, $file);
        global $twig;

        //this twig stuff should be moved to the view.php file
        $twig->addGlobal('path', new Path());
        //$twig->addGlobal('paths', Path);
        $twig->addGlobal('url', URL);
        $twig->addGlobal('session', new Session());
        $twig->addGlobal('csrf', new Csrf());
        echo $twig->render($viewObject->getPath(), $this->data);
    }

    protected function routePDF($path)
    {
        $view_object = new View($this->data, VIEWS_PATH.'/prints/'.$path.'.php');
        //var_dump($view_object);
        //exit;
        $content = $view_object->render();
        $layout_path = VIEWS_PATH.DS.$this->route.'.php';
        //echo $layout_path ;
        $layout_view_object = new View(compact('content'), $layout_path);
        //echo "<pre>";
        //var_dump($layout_view_object);
        //echo "</pre>";
        echo $layout_view_object->render();
    }
}
