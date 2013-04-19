<?php

namespace RtmTest;

use Rtm\DataContainer;
use Rtm\TestCase;

class DataContainerTest extends TestCase
{
    public function testEmptyConstructor()
    {
        $dc = new DataContainer;
        $this->assertCounts($dc, 0);
    }

    public function testNotEmptyConstructor()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertCounts($dc, 2);
    }

    public function testSet()
    {
        $dc = new DataContainer;
        $dc->set('param1', 'foo');
        $dc->set('param2', 'bar');
        $this->assertCounts($dc, 2);

        $anotherDc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals($anotherDc, $dc);
    }

    public function testSetByCall()
    {
        $dc = new DataContainer;
        $dc->setParam1('foo');
        $dc->setParam2('bar');
        $this->assertCounts($dc, 2);

        $anotherDc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals($anotherDc, $dc);
    }

    public function testGet()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals('foo', $dc->get('param1'));
        $this->assertEquals('bar', $dc->get('param2'));
    }

    public function testGetByCall()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals('foo', $dc->getParam1());
        $this->assertEquals('bar', $dc->getParam2());
    }

    public function testGetByCallDefaultValue()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertEquals('foo', $dc->getParam1());
        $this->assertEquals('bar', $dc->getParam2('baz'));
        $this->assertEquals('baz', $dc->getParam3('baz'));
        $this->assertNull($dc->getParam4());
    }

    public function testHas()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertTrue($dc->has('param1'));
        $this->assertTrue($dc->has('param2'));
        $this->assertFalse($dc->has('param3'));
    }

    public function testHasByCall()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertTrue($dc->hasParam1());
        $this->assertTrue($dc->hasParam2());
        $this->assertFalse($dc->hasParam3());
    }

    public function testRemove()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertTrue($dc->has('param1'));
        $this->assertTrue($dc->has('param2'));

        $dc->remove('param1');

        $this->assertFalse($dc->has('param1'));
        $this->assertTrue($dc->has('param2'));
        $this->assertCounts($dc, 1);

        $dc->remove('param2');

        $this->assertFalse($dc->has('param1'));
        $this->assertFalse($dc->has('param2'));
        $this->assertCounts($dc, 0);
    }

    public function testRemoveByCall()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $this->assertTrue($dc->has('param1'));
        $this->assertTrue($dc->has('param2'));

        $dc->removeParam1();

        $this->assertFalse($dc->has('param1'));
        $this->assertTrue($dc->has('param2'));
        $this->assertCounts($dc, 1);

        $dc->removeParam2();

        $this->assertFalse($dc->has('param1'));
        $this->assertFalse($dc->has('param2'));
        $this->assertCounts($dc, 0);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testBadMethodCall()
    {
        $dc = new DataContainer;
        $dc->iDontExist();
    }

    public function testSetChain()
    {
        $dc = new DataContainer;
        $dc->setParam1('foo')->setParam2('bar')->setParam3('baz');

        $this->assertEquals('foo', $dc->getParam1());
        $this->assertEquals('bar', $dc->getParam2());
        $this->assertEquals('baz', $dc->getParam3());
    }

    public function testRemoveChain()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $dc->removeParam1()->removeParam2();

        $this->assertFalse($dc->hasParam1());
        $this->assertFalse($dc->hasParam2());

        $this->assertCounts($dc, 0);
    }

    public function testToArray()
    {
        $dc = new DataContainer(array(
            'param1' => 'foo',
            'param2' => 'bar'
        ));

        $array = $dc->toArray();

        $this->assertArrayHasKey('param1', $array);
        $this->assertArrayHasKey('param2', $array);
    }

    public function testToArrayReccurency()
    {
        $dc = new DataContainer(array(
            'foo' => new DataContainer(array(
                'bar' => new DataContainer(array(
                    'baz' => new DataContainer(array(
                        'quux' => 'test'
                    ))
                ))
            ))
        ));

        $this->assertInstanceOf('Rtm\DataContainer', $dc->getFoo());
        $this->assertInstanceOf('Rtm\DataContainer', $dc->getFoo()->getBar());
        $this->assertInstanceOf('Rtm\DataContainer', $dc->getFoo()->getBar()->getBaz());

        $this->assertEquals('test', $dc->getFoo()->getBar()->getBaz()->getQuux());

        $array = $dc->toArray();

        $this->assertInternalType('array', $array);
        $this->assertArrayHasKey('foo', $array);

        $this->assertInternalType('array', $array['foo']);
        $this->assertArrayHasKey('bar', $array['foo']);

        $this->assertInternalType('array', $array['foo']['bar']);
        $this->assertArrayHasKey('baz', $array['foo']['bar']);

        $this->assertInternalType('array', $array['foo']['bar']['baz']);
        $this->assertArrayHasKey('quux', $array['foo']['bar']['baz']);

        $this->assertEquals('test', $array['foo']['bar']['baz']['quux']);
    }

    public function assertCounts(DataContainer $dc, $count)
    {
        $this->assertInstanceOf('ArrayIterator', $dc->getIterator());
        $this->assertInternalType('array', $dc->toArray());

        $this->assertEquals($count, $dc->count());
        $this->assertEquals($count, count($dc));
        $this->assertEquals($count, $dc->getIterator()->count());
        $this->assertEquals($count, count($dc->getIterator()));
        $this->assertEquals($count, count($dc->toArray()));
    }
}