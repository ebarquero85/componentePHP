<?php

namespace App\Providers;

use App\SessionArrayDriver;
use App\SessionManager;

class SessionProvider extends Provider
{

    public function register()
    {

        $this->container->bind('session', function(){

            $data = [
                'user_data' => array(
                    'name' => 'Edgard',
                    'role' => 'student'
                )
            ];

            $driver = new SessionArrayDriver($data);
            return new SessionManager($driver);

        });

    }

}