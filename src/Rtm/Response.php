<?php

namespace Rtm;

class Response
{
    private $response = null;

    public function __construct($response = null)
    {
        if (null !== $response) {
            $this->setResponse($response);
        }
    }

    public function setResponse($json)
    {
        $this->response = Toolkit::arrayToDataContainer(json_decode($json, true));
    }

    public function isValid()
    {
        return $this->response->getRsp()->getStat() == 'ok';
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