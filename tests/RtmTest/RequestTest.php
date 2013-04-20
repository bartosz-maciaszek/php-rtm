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

use Rtm\Rtm;
use Rtm\TestCase;
use Rtm\Request;

class RequestTest extends TestCase
{
    public function testEmptyRequest()
    {
        $request = new Request;
        $this->assertEquals(0, count($request->getParameters()));
    }

    public function testSetParametersViaConstructor()
    {
        $request = new Request(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals(2, count($request->getParameters()));
        $this->assertEquals('foo', $request->getParameter('param1'));
        $this->assertEquals('bar', $request->getParameter('param2'));
    }

    public function testSetParametersViaSetParameters()
    {
        $request = new Request;
        $request->setParameters(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals(2, count($request->getParameters()));
        $this->assertEquals('foo', $request->getParameter('param1'));
        $this->assertEquals('bar', $request->getParameter('param2'));

        $request->setParameters(array(
            'param3' => 'foo',
            'param4' => 'bar'
        ));

        $this->assertEquals(4, count($request->getParameters()));
        $this->assertEquals('foo', $request->getParameter('param3'));
        $this->assertEquals('bar', $request->getParameter('param4'));
    }

    public function testSetParametersViaSetParameter()
    {
        $request = new Request;
        $request->setParameter('param1', 'foo');
        $request->setParameter('param2', 'bar');

        $this->assertEquals(2, count($request->getParameters()));
        $this->assertEquals('foo', $request->getParameter('param1'));
        $this->assertEquals('bar', $request->getParameter('param2'));

        $request->setParameter('param3', 'foo');
        $request->setParameter('param4', 'bar');

        $this->assertEquals(4, count($request->getParameters()));
        $this->assertEquals('foo', $request->getParameter('param3'));
        $this->assertEquals('bar', $request->getParameter('param4'));
    }

    public function testGetParameterDefaultValues()
    {
        $request = new Request(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals('foo', $request->getParameter('param1'));
        $this->assertEquals('bar', $request->getParameter('param2'));

        $this->assertNull($request->getParameter('param3'));
        $this->assertNull($request->getParameter('param4'));

        $this->assertEquals('foo', $request->getParameter('param3', 'foo'));
        $this->assertEquals('bar', $request->getParameter('param4', 'bar'));
    }

    public function testHasParameter()
    {
        $request = new Request(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertTrue($request->hasParameter('param1'));
        $this->assertTrue($request->hasParameter('param2'));

        $this->assertFalse($request->hasParameter('param3'));
        $this->assertFalse($request->hasParameter('param4'));
    }

    public function testSign()
    {
        $request = new Request(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertFalse($request->isSigned());

        $request->sign('sdfasf345345');

        $this->assertTrue($request->isSigned());
        $this->assertEquals(32, strlen($request->getParameter('api_sig')));
    }

    public function testGetAuthUrl()
    {
        $request = new Request(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals(Rtm::URL_AUTH, substr($request->getAuthUrl(), 0, strlen(Rtm::URL_AUTH)));
        $this->assertEquals('param1=foo&param2=bar', parse_url($request->getAuthUrl(), PHP_URL_QUERY));
    }

    public function testGetServiceUrl()
    {
        $request = new Request(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals(Rtm::URL_SERVICE, substr($request->getServiceUrl(), 0, strlen(Rtm::URL_AUTH)));
        $this->assertEquals('param1=foo&param2=bar', parse_url($request->getServiceUrl(), PHP_URL_QUERY));
    }
}