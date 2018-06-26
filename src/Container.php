<?php
namespace App;


class Container
{

    protected static $instance;

    protected $shared = array();

    public static function getInstance()
    {

        if (static::$instance != null) {
            return static::$instance;
        }

        return static::$instance = New Container();

    }


    public function session()
    {

        if (isset($this->shared['session'])) {
            return $this->shared['session'];
        }

        $data = [
            'user_data' => array(
                'name' => 'Duilio',
                'role' => 'teacher'
            )
        ];

        $driver = New SessionArrayDriver($data);


        return $this->shared['session'] = New SessionManager($driver);

    }


    public function auth()
    {

        if (isset($this->shared['auth'])) {
            return $this->shared['auth'];
        }

        return $this->shared['auth'] = New Authenticator($this->session());

    }


    public function access()
    {

        if (isset($this->shared['access'])) {
            return $this->shared['access'];
        }

        return $this->shared['access'] = new AccessHandler($this->auth());

    }


}