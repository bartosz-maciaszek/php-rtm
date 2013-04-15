<?php

namespace Rtm;

interface ClientInterface
{
    public function setRtm(RtmInterface $rtm);

    public function call($method, array $params = array());
}