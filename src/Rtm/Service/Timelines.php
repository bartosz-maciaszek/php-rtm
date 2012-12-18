<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Timelines extends AbstractService
{
    public function create()
    {
        return $this->rtm->get(Rtm::METHOD_TIMELINES_CREATE)->getTimeline();
    }
}