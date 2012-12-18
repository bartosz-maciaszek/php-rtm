<?php

namespace Rtm;

class Rtm
{
    const SERVICE_URL = 'http://api.rememberthemilk.com/services/rest/';
    const AUTH_URL    = 'http://www.rememberthemilk.com/services/auth/';
    
    private $apiKey = null;
    
    private $secret = null;
    
    private $responseFormat = null;
    
    private $authToken = null;
    
    private $frob = null;
    
    private $client = null;
    
    public $auth = null;
    
    public function __construct($apiKey, $secret, $responseFormat = 'json')
    {
        $this->setApiKey($apiKey);
        $this->setSecret($secret);
        $this->setResponseFormat($responseFormat);
        
        $this->client = new Client($this);
        $this->auth = new Auth($this);
    }
    
    public function setFrob($frob)
    {
        $this->frob = $frob;
        return $this;
    }
    
    public function getFrob()
    {
        return $this->frob;
    }
    
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }
    
    public function getApiKey()
    {
        return $this->apiKey;
    }
    
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }
    
    public function getSecret()
    {
        return $this->secret;
    }
    
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }
    
    public function getAuthToken()
    {
        return $this->authToken;
    }
    
    public function setResponseFormat($responseFormat)
    {
        $this->responseFormat = $responseFormat;
        return $this;
    }
    
    public function getResponseFormat()
    {
        return $this->responseFormat;
    }
    
    public function get($method, array $params = array())
    {
        return $this->client->get($method, $params);
    }
    
    public function getAuthUrl($perms = 'read')
    {
        if (!$this->frob)
        {
            $this->auth->getFrob();
        }
        
        $request = new Request;
        $request->setParameter('api_key', $this->getApiKey());
        $request->setParameter('frob', $this->frob);
        $request->setParameter('perms', $perms);
        $request->sign($this->getSecret());
        
        return $request->getAuthUrl();
    }
}