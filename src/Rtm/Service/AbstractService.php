<?php

namespace Rtm\Service;

use Rtm\Rtm;

abstract class AbstractService
{
    /**
     * Rtm class object
     * @var Rtm\Rtm
     */
    protected $rtm;

    public function __construct(Rtm $rtm)
    {
        $this->rtm = $rtm;
    }
}