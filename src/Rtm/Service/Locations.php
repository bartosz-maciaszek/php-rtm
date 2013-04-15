<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Locations extends AbstractService
{
    public function getList()
    {
        return $this->rtm->call(Rtm::METHOD_LOCATIONS_GET_LIST)->getLocations()->getLocation();
    }
}