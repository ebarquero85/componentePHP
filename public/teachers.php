<?php

require __DIR__ . '/../bootstrap/start.php';

if(!Access::check('teacher')){
    abort404();
}

view('teachers');
