<?php

namespace App;

use App\Authenticator as Auth;

class AccessHandler
{

    /**
     * @var \App\Authenticator
     */
    protected $auth;

    /**
     * AccessHandler constructor.
     * @param \App\Authenticator $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function check($role){

        return $this->auth->check() && $this->auth->user()->role === $role;
    }

}