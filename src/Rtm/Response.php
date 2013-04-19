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
 * @package    Rtm
 * @author     Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 * @copyright  2013 Bartosz Maciaszek.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */

namespace Rtm;

class Response
{
    /**
     * JSON Response
     * @var string
     */
    private $response = null;

    /**
     * Stat OK
     * @var string
     */
    const STAT_OK = 'ok';

    /**
     * Constructor
     * @param string $response JSON response
     */
    public function __construct($response = null)
    {
        if (null !== $response) {
            $this->setResponse($response);
        }
    }

    /**
     * Set response
     * @param string $json JSON response
     */
    public function setResponse($json)
    {
        $this->response = Toolkit::arrayToDataContainer(json_decode($json, true));
    }

    /**
     * Is response valid?
     * @return boolean
     */
    public function isValid()
    {
        return $this->response->getRsp()->getStat() == self::STAT_OK;
    }

    /**
     * Get error message (if any)
     * @return string|null
     */
    public function getErrorMessage()
    {
        if ($this->response->getRsp()->hasErr()) {
            return $this->response->getRsp()->getErr()->getMsg();
        }
    }

    /**
     * Get error code (if any)
     * @return int|null
     */
    public function getErrorCode()
    {
        if ($this->response->getRsp()->hasErr()) {
            return $this->response->getRsp()->getErr()->getCode();
        }
    }

    /**
     * Get the whole response
     * @return DataContainer
     */
    public function getResponse()
    {
        return $this->response->getRsp();
    }
}