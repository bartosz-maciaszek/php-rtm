<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Timezones extends AbstractService
{
    public function getList()
    {
        return $this->rtm->call(Rtm::METHOD_TIMEZONES_GET_LIST)->getTimezones()->getTimezone();
    }
}