<?php

namespace App;

use App\SessionFileDriver as Driver;

class SessionManager
{

    protected $loaded = false;
    protected $data = array();

    /**
     * @var \App\SessionFileDriver
     */
    private $driver;

    /**
     * SessionManager constructor.
     * @param \App\SessionFileDriver $driver
     */
    public function __construct(SessionDriverInterface $driver)
    {
        $this->driver = $driver;

        $this->load();

    }

    private function load()
    {

        $this->data = $this->driver->load();

    }

    public function get($key)
    {

        return isset($this->data[$key])
            ? $this->data[$key]
            : null;

    }

}