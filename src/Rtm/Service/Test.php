<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Test extends AbstractService
{
    public function ping()
    {
        return $this->rtm->get(Rtm::METHOD_TEST_ECHO);
    }

    public function login()
    {
        return $this->rtm->get(Rtm::METHOD_TEST_LOGIN)->getUser();
    }
}