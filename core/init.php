<?php
require_once __DIR__  . '/../vendor/autoload.php';
//load configuration settings
configure_settings();
//loads database settings
loadDatabase();
//loads 
loadPaths();
//loads the twig framework
loadTwig();

$loader = new Twig_Loader_Filesystem(VIEWS_PATH);
    $twig = new Twig_Environment(
        $loader,
        array(
        'cache' => CACHE_PATH,
        )
    );