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