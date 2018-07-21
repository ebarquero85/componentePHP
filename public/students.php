<?php

require __DIR__ . '/../bootstrap/start.php';


if(!Access::check('student')){
    abort404();
}

view('students');
