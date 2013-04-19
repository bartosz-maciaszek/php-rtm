<?php

namespace RtmTest;

use Rtm\TestCase;
use Rtm\Toolkit;

class ToolkitTest extends TestCase
{
    public function testArrayToDataContainerOneDimension()
    {
        $dc = Toolkit::arrayToDataContainer(array(
            'param1' => 'foo1',
            'param2' => 'bar1'
        ));

        $this->assertInstanceOf('Rtm\DataContainer', $dc);

        $this->assertEquals('foo1', $dc->getParam1());
        $this->assertEquals('bar1', $dc->getParam2());
    }

    public function testArrayToDataContainerTwoDimensions()
    {
        $dc = Toolkit::arrayToDataContainer(array(
            'param1' => 'foo1',
            'param2' => 'bar1',
            'param3' => array(
                'param1' => 'foo2',
                'param2' => 'bar2'
            )
        ));

        $this->assertInstanceOf('Rtm\DataContainer', $dc);
        $this->assertInstanceOf('Rtm\DataContainer', $dc->getParam3());

        $this->assertEquals('foo1', $dc->getParam1());
        $this->assertEquals('bar1', $dc->getParam2());
        $this->assertEquals('foo2', $dc->getParam3()->getParam1());
        $this->assertEquals('bar2', $dc->getParam3()->getParam2());
    }

    public function testArrayToDataContainerThreeDimensions()
    {
        $dc = Toolkit::arrayToDataContainer(array(
            'param1' => 'foo1',
            'param2' => 'bar1',
            'param3' => array(
                'param1' => 'foo2',
                'param2' => 'bar2',
                'param3' => array(
                    'param1' => 'foo3',
                    'param2' => 'bar3'
                )
            )
        ));

        $this->assertInstanceOf('Rtm\DataContainer', $dc);
        $this->assertInstanceOf('Rtm\DataContainer', $dc->getParam3());
        $this->assertInstanceOf('Rtm\DataContainer', $dc->getParam3()->getParam3());

        $this->assertEquals('foo1', $dc->getParam1());
        $this->assertEquals('bar1', $dc->getParam2());
        $this->assertEquals('foo2', $dc->getParam3()->getParam1());
        $this->assertEquals('bar2', $dc->getParam3()->getParam2());
        $this->assertEquals('foo3', $dc->getParam3()->getParam3()->getParam1());
        $this->assertEquals('bar3', $dc->getParam3()->getParam3()->getParam2());
    }
}