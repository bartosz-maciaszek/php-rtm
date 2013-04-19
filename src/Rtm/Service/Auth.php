<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Auth extends AbstractService
{
    public function checkToken($authToken = null)
    {
        if (null === $authToken) {
            $authToken = $this->rtm->getAuthToken();
        }

        return $this->rtm->call(Rtm::METHOD_AUTH_CHECK_TOKEN, array('auth_token' => $authToken))->getAuth();
    }

    public function getFrob()
    {
        $response = $this->rtm->call(Rtm::METHOD_AUTH_GET_FROB);

        $this->rtm->setFrob($response->getFrob());
        return $this->rtm->getFrob();
    }

    public function getToken($frob = null)
    {
        if (null === $frob) {
            $frob = $this->getFrob();
        }

        return $this->rtm->call(Rtm::METHOD_AUTH_GET_TOKEN, array('frob' => $frob))->getAuth();
    }
}