<?php

namespace App\Providers;


use App\Authenticator;

class AuthenticatorProvider extends Provider
{

    public function register()
    {

        $this->container->bind('auth', function($container){
            return new Authenticator($container->make('session'));
        });

    }
}