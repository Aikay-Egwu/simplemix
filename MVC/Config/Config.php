<?php
use MVC\Library\Config as Config ;

function configure_settings()
{
    Config::set('site_name', 'SimpleMix');
    Config::set('languages', array('en'));
    //routes.  Route name => method prefix
    Config::set(
        'routes',
        array(
        'default' => '',
        'admin' => 'admin'
        )
    );
    
    //default page
    Config::set('default_route', 'default');
    //default site language
    Config::set('default_language', 'en');
    //default controller
    Config::set('default_controller', 'home');
    //default action
    Config::set('default_action', 'index');
}
