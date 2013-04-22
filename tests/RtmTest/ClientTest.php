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
use Rtm\Client;

class ClientTest extends TestCase
{
    /**
     * @expectedException Rtm\Exception
     */
    public function testNoRtmByDefault()
    {
        $client = new Client;
        $client->getRtm();
    }

    public function testSetRtm()
    {
        $client = new Client;
        $client->setRtm(new Rtm);

        $this->assertInstanceOf('Rtm\Rtm', $client->getRtm());
    }

    /**
     * @expectedException Rtm\Exception
     */
    public function testCallWithoutRtm()
    {
        $client = new Client;
        $client->call('test', array('param1' => 'foo', 'param2' => 'bar'));
    }

    /**
     * @expectedException Rtm\Exception
     */
    public function testCreateRequestWithoutRtm()
    {
        $client = new Client;
        $client->createRequest('test', array('param1' => 'foo', 'param2' => 'bar'));
    }

    public function testCreateRequestWithRtm()
    {
        $rtm = new Rtm;
        $rtm->setApiKey('asjhdfskjdfs');
        $rtm->setSecret('1asdas534666');
        $rtm->setAuthToken('gfg77764g');

        $client = new Client;
        $client->setRtm($rtm);

        $request = $client->createRequest('test', array('param1' => 'foo', 'param2' => 'bar'));

        $this->assertInstanceOf('Rtm\Request', $request);
        $this->assertEquals('test', $request->getParameter('method'));
        $this->assertEquals('json', $request->getParameter('format'));
        $this->assertEquals('foo', $request->getParameter('param1'));
        $this->assertEquals('bar', $request->getParameter('param2'));
        $this->assertEquals('asjhdfskjdfs', $request->getParameter('api_key'));
        $this->assertEquals('gfg77764g', $request->getParameter('auth_token'));
        $this->assertTrue($request->isSigned());
    }

    public function testCreateValidResponse()
    {
        $json = '{"rsp": {"stat": "ok", "foo": "bar", "baz": "quux"}}';

        $client = new Client;
        $response = $client->createResponse($json);

        $this->assertInstanceOf('Rtm\Response', $response);
    }

    /**
     * @expectedException Rtm\Exception
     */
    public function testCreateInvalidResponse()
    {
        $json = '{"rsp": {"stat": "err", "err": {"msg": "Test error", "code": 123}}}';

        $client = new Client;
        $response = $client->createResponse($json);
    }
}
