<?php

use App\AccessHandler;
use App\Authenticator;
use App\Container;
use App\SessionArrayDriver;
use App\SessionManager;

require __DIR__ . '/../vendor/autoload.php';

class_alias('App\Facades\Access', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();



$container = Container::getInstance();

Access::setContainer($container);

$container->bind('session', function(){

    $data = [
        'user_data' => array(
            'name' => 'Edgard',
            'role' => 'student'
        )
    ];

    $driver = new SessionArrayDriver($data);
    return new SessionManager($driver);
});

$container->bind('auth', function($container){
    return new Authenticator($container->make('session'));
});

$container->bind('access', function($container){
    return new AccessHandler($container->make('auth'));
});

//echo '<pre>';
//die(var_dump($container));