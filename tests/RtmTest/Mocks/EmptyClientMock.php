<?php

namespace RtmTest\Mocks;

use Rtm\RtmInterface;
use Rtm\ClientInterface;

class EmptyClientMock implements ClientInterface
{
    public function setRtm(RtmInterface $rtm)
    {

    }

    public function call($method, array $params = array())
    {

    }
}