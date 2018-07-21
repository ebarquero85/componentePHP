<?php

namespace App;


use App\Providers\SessionProvider;

class Application
{

    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $providers
     */
    public function registerProviders(array $providers)
    {

        foreach($providers as $provider){

            $provider = new $provider($this->container);
            $provider->register();
        }

    }

    public function register()
    {

        $this->registerSessionManager();
        $this->registerAuthenticator();
        $this->registerAccessHandler();

    }

    public function registerSessionManager()
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

    public function registerAuthenticator()
    {

        $this->container->bind('auth', function($container){
            return new Authenticator($container->make('session'));
        });

    }

    public function registerAccessHandler()
    {

        $this->container->bind('access', function($container){
            return new AccessHandler($container->make('auth'));
        });

    }


}

