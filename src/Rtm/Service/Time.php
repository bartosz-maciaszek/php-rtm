<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2013 Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @package    Rtm.Service
 * @author     Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 * @copyright  2013 Bartosz Maciaszek.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */

namespace Rtm\Service;

use Rtm\Rtm;

class Time extends AbstractService
{
    /**
     * Returns the specified $time in the desired timezone.
     * @param  string  $toTimezone
     * @param  string  $fromTimezone
     * @param  integer $time
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.time.convert.rtm
     */
    public function convert($toTimezone, $fromTimezone = null, $time = null)
    {
        $params = array(
            'to_timezone' => $toTimezone,
            'from_timezone' => $fromTimezone,
            'time' => $time
        );

        return $this->rtm->call(Rtm::METHOD_TIME_CONVERT, $params)->getTime();
    }

    /**
     * Returns the time, in UTC, for the parsed input.
     * @param  integer $text
     * @param  string  $timezone
     * @param  string  $dateFormat
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.time.parse.rtm
     */
    public function parse($text, $timezone = null, $dateFormat = null)
    {
        $params = array(
            'text'       => $text,
            'timezone'   => $timezone,
            'dateformat' => $dateFormat
        );

        return $this->rtm->call(Rtm::METHOD_TIME_PARSE, $params)->getTime();
    }
}
