<?php

namespace App\Providers;

use App\AccessHandler;

class AccessHandlerProvider extends Provider
{

    public function register()
    {

        $this->container->bind('access', function($container){
            return new AccessHandler($container->make('auth'));
        });

    }

}