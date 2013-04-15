<?php

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

        $this->assertFalse($request->hasParameter('api_sig'));

        $request->sign('sdfasf345345');

        $this->assertTrue($request->hasParameter('api_sig'));
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