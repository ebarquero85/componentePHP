<?php

namespace App;


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
    public function __construct(AuthenticatorInterface $auth)
    {
        $this->auth = $auth;
    }

    public function check($role){

        return $this->auth->check() && $this->auth->user()->role === $role;
    }

}