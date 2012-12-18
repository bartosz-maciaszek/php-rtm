<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Auth
{
    /**
     * Rtm object
     * @var Rtm\Rtm
     */
    private $rtm;

    function __construct(Rtm $rtm)
    {
        $this->rtm = $rtm;
    }

    public function checkToken($authToken = null)
    {
        if(null === $authToken)
        {
            $authToken = $this->rtm->getAuthToken();
        }

        return $this->rtm->get(Rtm::METHOD_AUTH_CHECK_TOKEN, array('auth_token' => $authToken));
    }

    public function getFrob()
    {
        $frobResponse = $this->rtm->get(Rtm::METHOD_AUTH_GET_FROB);
        $this->rtm->setFrob($frobResponse->getFrob());
        return $this->rtm->getFrob();
    }

    public function getToken($frob = null)
    {
        if(!$frob)
        {
            $frob = $this->getFrob();
        }

        return $this->rtm->get(Rtm::METHOD_AUTH_GET_TOKEN, array('frob' => $frob));
    }

}