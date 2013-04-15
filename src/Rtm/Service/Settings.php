<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Settings extends AbstractService
{
    public function getList()
    {
        return $this->rtm->call(Rtm::METHOD_SETTINGS_GET_LIST)->getSettings();
    }
}