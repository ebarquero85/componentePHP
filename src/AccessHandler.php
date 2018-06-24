<?php

namespace App;

class AccessHandler
{

    public static function check($role){

        return Authenticator::check() && Authenticator::user()->rol === $role;

    }

}