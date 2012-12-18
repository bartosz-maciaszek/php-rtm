<?php

namespace Rtm;

class Request
{
    private $parameters = array();
    
    public function __construct(array $parameters = null)
    {
        if (is_array($parameters))
        {
            $this->parameters = $parameters;
        }
    }
    
    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }
    
    public function getParameter($name, $default = null)
    {
        if ($this->hasParameter($name) === false)
        {
            return $default;
        }
        
        return $this->parameters[$name];
    }
    
    public function hasParameter($name)
    {
        return isset($this->parameters[$name]);
    }
    
    public function sign($secret)
    {
        $params = $this->parameters;
        
        ksort($params);
        
        $sig = '';
        
        foreach ($params as $key => $val)
        {
            if ($val != '')
            {
                $sig .= $key . $val;
            }
        }
        
        $this->setParameter('api_sig', md5($secret . $sig));
    }
    
    public function getServiceUrl()
    {
        return Rtm::SERVICE_URL . '?' . http_build_query($this->parameters);
    }
    
    public function getAuthUrl()
    {
        return Rtm::AUTH_URL . '?' . http_build_query($this->parameters);
    }
}