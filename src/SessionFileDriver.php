<?php

namespace App;


use function file_exists;
use function file_get_contents;
use function json_decode;

class SessionFileDriver
{

    public static function load()
    {

        $file = __DIR__ .  '/../storage/session/session.json';

        if(file_exists($file)){
            return json_decode(file_get_contents($file), true);
        }

        return [];


    }


}