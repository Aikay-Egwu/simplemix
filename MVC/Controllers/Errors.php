<?php
namespace MVC\Controllers ;

use MVC\Library\Controller;

class Errors extends Controller
{
    public function __construct($data = array())
    {
         parent::__construct($data);
    }


    public function error404()
    {
        $this->route();
    }
}
