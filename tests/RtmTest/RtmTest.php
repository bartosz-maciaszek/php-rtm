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

use Rtm\TestCase;
use Rtm\Rtm;
use Rtm\Client;
use Rtm\ClientInterface;

class RtmTest extends TestCase
{
    public function testDefaultClient()
    {
        $rtm = new Rtm;
        $this->assertTrue($rtm->getClient() instanceof Client);
        $this->assertTrue($rtm->getClient() instanceof ClientInterface);
    }

    public function testOverrideDefaultClient()
    {
        $rtm = new Rtm;
        $rtm->setClient(new Mocks\EmptyClientMock);
        $this->assertTrue($rtm->getClient() instanceof Mocks\EmptyClientMock);
        $this->assertTrue($rtm->getClient() instanceof ClientInterface);

        $rtm = new Rtm(array(
            'client' => new Mocks\EmptyClientMock
        ));
        $this->assertTrue($rtm->getClient() instanceof Mocks\EmptyClientMock);
        $this->assertTrue($rtm->getClient() instanceof ClientInterface);
    }

    /**
     * @expectedException Rtm\Exception
     */
    public function testNotSetFrob()
    {
        $rtm = new Rtm;
        $rtm->getFrob();
    }

    public function testSetFrob()
    {
        $rtm = new Rtm;
        $rtm->setFrob('v34o5dfg743535gfb');
        $this->assertEquals('v34o5dfg743535gfb', $rtm->getFrob());

        $rtm = new Rtm(array(
            'frob' => 'v34o5dfg743535gfb'
        ));
        $this->assertEquals('v34o5dfg743535gfb', $rtm->getFrob());
    }

    /**
     * @expectedException \Rtm\Exception
     */
    public function testNotSetTimeline()
    {
        $rtm = new Rtm;
        $rtm->getTimeline();
    }

    public function testSetTimeline()
    {
        $rtm = new Rtm;
        $rtm->setTimeline('1231235345345');
        $this->assertEquals('1231235345345', $rtm->getTimeline());

        $rtm = new Rtm(array(
            'timeline' => '1231235345345'
        ));
        $this->assertEquals('1231235345345', $rtm->getTimeline());
    }

    /**
     * @expectedException \Rtm\Exception
     */
    public function testNotSetApiKey()
    {
        $rtm = new Rtm;
        $rtm->getApiKey();
    }

    public function testSetApiKey()
    {
        $rtm = new Rtm;
        $rtm->setApiKey('e245k63469bdfg8dfg034rwfsdf');
        $this->assertEquals('e245k63469bdfg8dfg034rwfsdf', $rtm->getApiKey());

        $rtm = new Rtm(array(
            'apiKey' => 'e245k63469bdfg8dfg034rwfsdf'
        ));
        $this->assertEquals('e245k63469bdfg8dfg034rwfsdf', $rtm->getApiKey());
    }

    /**
     * @expectedException \Rtm\Exception
     */
    public function testNotSetSecret()
    {
        $rtm = new Rtm;
        $rtm->getSecret();
    }

    public function testSetSecret()
    {
        $rtm = new Rtm;
        $rtm->setSecret('e245k63469bdfg8dfg034rwfsdf');
        $this->assertEquals('e245k63469bdfg8dfg034rwfsdf', $rtm->getSecret());

        $rtm = new Rtm(array(
            'secret' => 'e245k63469bdfg8dfg034rwfsdf'
        ));
        $this->assertEquals('e245k63469bdfg8dfg034rwfsdf', $rtm->getSecret());
    }

    public function testNotSetAuthKey()
    {
        $rtm = new Rtm;
        $this->assertNull($rtm->getAuthToken());
    }

    public function testSetAuthToken()
    {
        $rtm = new Rtm;
        $rtm->setAuthToken('e245k63469bdfg8dfg034rwfsdf');
        $this->assertEquals('e245k63469bdfg8dfg034rwfsdf', $rtm->getAuthToken());

        $rtm = new Rtm(array(
            'authToken' => 'e245k63469bdfg8dfg034rwfsdf'
        ));
        $this->assertEquals('e245k63469bdfg8dfg034rwfsdf', $rtm->getAuthToken());
    }

    /**
     * @expectedException \Rtm\Exception
     */
    public function testDefaultGetAuthUrl()
    {
        $rtm = new Rtm;
        $rtm->getAuthUrl(Rtm::AUTH_TYPE_WRITE);
    }

    public function testProperGetAuthUrl()
    {
        $rtm = new Rtm;
        $rtm->setApiKey('dfgdfgsdgsgsdfgdfg');
        $rtm->setSecret('gd34tdvxvdfvdfgvdd');

        $url = $rtm->getAuthUrl(Rtm::AUTH_TYPE_WRITE);

        $this->assertEquals(Rtm::URL_AUTH, substr($url, 0, strlen(Rtm::URL_AUTH)));
        $this->assertRegExp('/api_key=dfgdfgsdgsgsdfgdfg&perms=write&api_sig=\w{32}$/', parse_url($url, PHP_URL_QUERY));
    }

    /**
     * @expectedException Rtm\Exception
     */
    public function testCallWithoutMandatoryConfiguration()
    {
        $rtm = new Rtm;
        $rtm->call(Rtm::METHOD_TEST_ECHO);
    }

    public function testGetExistingService()
    {
        $rtm = new Rtm;
        $service = $rtm->getService(Rtm::SERVICE_TEST);

        $this->assertInstanceOf('Rtm\Service\AbstractService', $service);
        $this->assertInstanceOf('Rtm\Service\Test', $service);
    }
}
