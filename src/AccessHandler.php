<?php

namespace App;

use App\Authenticator as Auth;

class AccessHandler
{

    /**
     * @var \App\AuthenticatorInterface
     */
    protected $auth;

    /**
     * AccessHandler constructor.
     * @param AuthenticatorInterface $auth
     */
    public function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    public function check($role){

        return $this->auth->check() && $this->auth->user()->role === $role;
    }

}