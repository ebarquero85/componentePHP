<?php

require __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$data = [
    'user_data' => array(
        'name' => 'Duilio',
        'role' => 'student'
    )
];

$driver = New App\SessionArrayDriver($data);
$session = New App\SessionManager($driver);
$auth = New App\Authenticator($session);
$access = new App\AccessHandler($auth);