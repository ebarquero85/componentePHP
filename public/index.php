<?php

use App\Container;

require __DIR__ . '/../bootstrap/start.php';

$access = Container::getInstance()->access();

view('index', compact('access'));

