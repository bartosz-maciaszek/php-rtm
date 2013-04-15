<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Reflection extends AbstractService
{
    public function getMethodInfo($method)
    {
        $params = array(
            'method_name' => $method
        );

        return $this->rtm->call(Rtm::METHOD_REFLECTION_GET_METHOD_INFO, $params)->getMethod();
    }

    public function getMethods()
    {
        return $this->rtm->call(Rtm::METHOD_REFLECTION_GET_METHODS)->getMethods()->getMethod();
    }
}