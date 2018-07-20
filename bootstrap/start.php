<?php

use App\AccessHandler;
use App\Authenticator;
use App\Container;
use App\SessionArrayDriver;
use App\SessionManager;

require __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();



$container = Container::getInstance();

$container->bind('session', function(){
    $data = [
        'user_data' => array(
            'name' => 'Edgard',
            'role' => 'teacher'
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

