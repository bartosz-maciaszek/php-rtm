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

use Rtm\Rtm;
use RtmTest\Mocks\ServiceTestClientMock;

abstract class ServiceTestCase extends TestCase
{
    const API_KEY = 'asdfghrtuytjhgj';
    const SECRET = 'dfkgjdgdfgdfgdf';
    const AUTH_TOKEN = 'sgfg7thfghfdfgfsd';
    const FROB = 'hfgy5rty54dfgdfgh';

    abstract public function getServiceMethodsMatrix();

    /**
     * @dataProvider getServiceMethodsMatrix
     */
    public function testServiceMethod($serviceName, $methodName, array $parameters, array $expectedParameters)
    {
        $rtm = new Rtm;
        $rtm->setApiKey(self::API_KEY);
        $rtm->setSecret(self::SECRET);
        $rtm->setAuthToken(self::AUTH_TOKEN);
        $rtm->setFrob(self::FROB);
        $rtm->setClient(new ServiceTestClientMock);

        $service = $rtm->getService($serviceName);

        $reflection = new \ReflectionObject($service);
        $method = $reflection->getMethod(preg_replace('/^[\w\.]+\.(\w+)$/', '\1', $methodName));
        $response = $method->invokeArgs($service, $parameters);

        $this->assertEquals($serviceName, $response->__getService());
        $this->assertEquals($methodName, $response->__getMethod());
        $this->assertEquals($expectedParameters, $response->__getParams());
    }
}
