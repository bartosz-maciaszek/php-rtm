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
 * @package    RtmTest
 * @author     Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 * @copyright  2013 Bartosz Maciaszek.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */

namespace RtmTest;

use Rtm\Response;
use Rtm\TestCase;

class ResponseTest extends TestCase
{
    public function testHandleSimpleSuccessfulResponse()
    {
        $json = '{"rsp": {"stat": "ok", "foo": "bar", "baz": "quux"}}';

        $response = new Response($json);

        $this->assertInstanceOf('Rtm\DataContainer', $response->getResponse());

        $this->assertTrue($response->isValid());

        $this->assertEquals('bar', $response->getResponse()->getFoo());
        $this->assertEquals('quux', $response->getResponse()->getBaz());
    }

    public function testHandleComplexSuccessfulResponse()
    {
        $json = '{"rsp": {"stat": "ok", "param1": "foo1", "param2": "bar1", "param3": {"param1": "foo2", "param2": "bar2", "param3": {"param1": "foo3", "param2": "bar3"}}}}';

        $response = new Response($json);

        $this->assertInstanceOf('Rtm\DataContainer', $response->getResponse());
        $this->assertInstanceOf('Rtm\DataContainer', $response->getResponse()->getParam3());
        $this->assertInstanceOf('Rtm\DataContainer', $response->getResponse()->getParam3()->getParam3());

        $this->assertTrue($response->isValid());

        $this->assertEquals('foo1', $response->getResponse()->getParam1());
        $this->assertEquals('bar1', $response->getResponse()->getParam2());
        $this->assertEquals('foo2', $response->getResponse()->getParam3()->getParam1());
        $this->assertEquals('bar2', $response->getResponse()->getParam3()->getParam2());
        $this->assertEquals('foo3', $response->getResponse()->getParam3()->getParam3()->getParam1());
        $this->assertEquals('bar3', $response->getResponse()->getParam3()->getParam3()->getParam2());
    }

    public function testHandleSimpleErrorResponse()
    {
        $json = '{"rsp": {"stat": "err", "err": {"msg": "Test error", "code": 123}}}';

        $response = new Response($json);

        $this->assertInstanceOf('Rtm\DataContainer', $response->getResponse());

        $this->assertFalse($response->isValid());
        
        $this->assertEquals('Test error', $response->getErrorMessage());
        $this->assertEquals('123', $response->getErrorCode());
    }
}