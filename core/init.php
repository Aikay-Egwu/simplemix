<?php
require_once __DIR__  . '/../vendor/autoload.php';
configure_settings();
loadDatabase();
loadPaths();
loadTwig();

$loader = new Twig_Loader_Filesystem(VIEWS_PATH);
    $twig = new Twig_Environment(
        $loader,
        array(
        'cache' => CACHE_PATH,
        )
    );