<?php

namespace App\Facades;

use App\Container;

class Access
{

    public static function check($roles)
    {

        return Container::getInstance()->make('access')->check($roles);

    }

}