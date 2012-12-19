<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Time extends AbstractService
{
    public function convert($toTimezone, $fromTimezone = null, $time = null)
    {
        $params = array(
            'to_timezone' => $toTimezone,
            'from_timezone' => $fromTimezone,
            'time' => $time
        );

        return $this->rtm->get(Rtm::METHOD_TIME_CONVERT, $params)->getTime();
    }

    public function parse($text, $timezone = null, $dateFormat = null)
    {
        $params = array(
            'text'       => $text,
            'timezone'   => $timezone,
            'dateformat' => $dateFormat
        );

        return $this->rtm->get(Rtm::METHOD_TIME_PARSE, $params)->getTime();
    }
}