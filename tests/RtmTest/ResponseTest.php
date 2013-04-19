<?php

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