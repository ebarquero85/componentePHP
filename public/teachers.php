<?php

use App\Container;

require __DIR__ . '/../bootstrap/start.php';

$access = Container::getInstance()->make('access');

if(!$access->check('teacher')){
    abort404();
}

view('teachers');
