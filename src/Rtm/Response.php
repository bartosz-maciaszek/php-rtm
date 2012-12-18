<?php

namespace Rtm;

use stdClass;

class Response
{
    private $response = null;
    
    private $type = null;
    
    const STAT_OK = 'ok';
    
    public function __construct($response, $type)
    {
        $response = $this->arrayToObject(json_decode($response, true));
        
        $this->response = $response;
        $this->type = $type;
    }
    
    public function arrayToObject($d)
    {
        return is_array($d) ? new DataContainer(array_map(__METHOD__, $d)) : $d;
    }
    
    public function isValid()
    {
        return $this->response->getRsp()->getStat() == self::STAT_OK;
    }
    
    public function getErrorMessage()
    {
        return $this->response->getRsp()->getErr()->getMsg();
    }
    
    public function getErrorCode()
    {
        return $this->response->getRsp()->getErr()->getCode();
    }
    
    public function getResponse()
    {
        return $this->response->getRsp();
    }
}