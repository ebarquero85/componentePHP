<?php

namespace App;

use App\SessionManager as Session;


class Authenticator implements AuthenticatorInterface
{

    public $user;

    /**
     * @var \App\SessionManager
     */
    private $session;

    /**
     * Authenticator constructor.
     * @param \App\SessionManager $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function check()
    {

        return $this->user() != null;
    }

    public function user()
    {

        if ( ! is_null($this->user)) {
            return $this->user;
        }

        $data = $this->session->get('user_data');

        if( ! is_null($data)){
            return $this->user = new User($data);
        }

        return null;

    }


}