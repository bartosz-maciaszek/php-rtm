<?php

namespace Rtm;

class Auth
{
    private $rtm;
    
    function __construct(Rtm $rtm)
    {
        $this->rtm = $rtm;
    }
    
    public function checkToken($authToken)
    {
        return $this->rtm->get('rtm.auth.checkToken', array('auth_token' => $authToken));
    }
    
    public function getFrob()
    {
        $frobResponse = $this->rtm->get("rtm.auth.getFrob");
        $this->rtm->setFrob($frobResponse["frob"]);
        return $this->rtm->getFrob();
    }
    
    public function getToken($frob = null)
    {
        if(!$frob)
        {
            $frob = $this->getFrob();
        }
         
        $tokenResponse = $this->rtm->get("rtm.auth.getToken", array("frob" => $frob));
        $this->rtm->setAuthToken($tokenResponse['auth']["token"]);
        return $tokenResponse;
    }
}