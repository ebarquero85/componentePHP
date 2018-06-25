<?php

require __DIR__ . '/../bootstrap/start.php';

if(!$access->check('teacher')){
    abort404();
}

view('teachers');
