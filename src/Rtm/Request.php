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

class Request
{
    private $parameters = array();

    public function __construct(array $parameters = null)
    {
        if (is_array($parameters)) {
            $this->setParameters($parameters);
        }
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    public function getParameter($name, $default = null)
    {
        if (false === $this->hasParameter($name)) {
            return $default;
        }

        return $this->parameters[$name];
    }

    public function hasParameter($name)
    {
        return isset($this->parameters[$name]);
    }

    public function sign($secret)
    {
        $params = $this->parameters;

        ksort($params);

        $sig = '';

        foreach ($params as $key => $val) {
            if ($val != '') {
                $sig .= $key . $val;
            }
        }

        $this->setParameter('api_sig', md5($secret . $sig));
    }

    public function getServiceUrl()
    {
        return Rtm::URL_SERVICE . '?' . http_build_query($this->parameters);
    }

    public function getAuthUrl()
    {
        return Rtm::URL_AUTH . '?' . http_build_query($this->parameters);
    }
}