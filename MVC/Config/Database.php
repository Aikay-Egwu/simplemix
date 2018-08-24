<?php

use Illuminate\Database\Capsule\Manager as Capsule ;

function loadDatabase()
{
    $capsule = new Capsule();
    $capsule->addConnection(
        [
        'driver' => 'mysql',
        //database host
        'host' => 'localhost',
        //database name
        'database' =>  '',
        //database username
        'username' => '',
        //database passwords
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        ]
    );
    $capsule->bootEloquent();
}
