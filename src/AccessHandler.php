<?php

namespace App;


class AccessHandler
{

    public static function check($role){

        return 'admin' === $role;

    }

}