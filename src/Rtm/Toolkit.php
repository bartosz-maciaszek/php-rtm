<?php

namespace Rtm;

class Toolkit
{
    public static function arrayToDataContainer($d)
    {
        return is_array($d) ? new DataContainer(array_map(__METHOD__, $d)) : $d;
    }
}
