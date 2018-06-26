<?php

use App\Container;

require __DIR__ . '/../bootstrap/start.php';

$access = Container::getInstance()->access();

if(!$access->check('teacher')){
    abort404();
}

view('teachers');
