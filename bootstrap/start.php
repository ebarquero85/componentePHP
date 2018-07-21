<?php

use App\Application;
use App\Container;

require __DIR__ . '/../vendor/autoload.php';

class_alias('App\Facades\Access', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$container = Container::getInstance();

Access::setContainer($container);

$application = new Application($container);

//$application->register();

$application->registerProviders(array(
    App\Providers\SessionProvider::class,
    App\Providers\AuthenticatorProvider::class,
    App\Providers\AccessHandlerProvider::class,
));
