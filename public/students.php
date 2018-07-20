<?php

use App\Container;

require __DIR__ . '/../bootstrap/start.php';

$access = Container::getInstance()->make('access');

if(!$access->check('student')){
    abort404();
}

view('students', compact('access'));
