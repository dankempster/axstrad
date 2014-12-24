<?php
namespace Axstrad\Component\Collection\Tests;

use Axstrad\Component\Collection\ObjectCollection;
use Axstrad\Component\Test\TestCase;
use DateTime;
use StdClass;


/**
 * @group unittest
 */
class ObjectCollectionTests extends TestCase
{
    protected $values = array();

    public function setUp()
    {
        $this->values = array(
            array(new StdClass, 'My Info'),
            array(new DateTime, 'Time Tracker'),
            array(new StdClass, 'Jack\'s Info'),
        );

        $storage = new \SplObjectStorage;
        foreach ($this->values as $args) {
            call_user_func_array(array($storage, 'attach'), $args);
        }

        $this->fixture = new ObjectCollection($storage);
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::offsetExists
     */
    public function testOffsetExists1()
    {
        $this->assertTrue(
            $this->fixture->offsetExists($this->values[0][0])
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::offsetExists
     */
    public function testOffsetExists2()
    {
        $this->assertFalse(
            $this->fixture->offsetExists(new StdClass)
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::toArray
     */
    public function testToArray()
    {
        $this->assertEquals(
            array(
                array(
                    'object' => $this->values[0][0],
                    'info' => $this->values[0][1],
                ),
                array(
                    'object' => $this->values[1][0],
                    'info' => $this->values[1][1],
                ),
                array(
                    'object' => $this->values[2][0],
                    'info' => $this->values[2][1],
                ),
            ),
            $this->fixture->toArray()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::last
     */
    public function testLastMethod()
    {
        $this->assertEquals(
            $this->values[2][0],
            $this->fixture->last()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::first
     * @uses Axstrad\Component\Collection\ObjectCollection::last
     */
    public function testFirstMethod()
    {
        $this->fixture->last();
        $this->assertEquals(
            $this->values[0][0],
            $this->fixture->first()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::key
     * @uses Axstrad\Component\Collection\ObjectCollection::first
     */
    public function testKeyMethod1()
    {
        $this->fixture->first();
        $this->assertEquals(
            0, $this->fixture->key()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::key
     * @uses Axstrad\Component\Collection\ObjectCollection::last
     */
    public function testKeyMethod2()
    {
        $this->fixture->last();
        $this->assertEquals(
            2,
            $this->fixture->key()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::current
     * @uses Axstrad\Component\Collection\ObjectCollection::first
     */
    public function testCurrentMethod1()
    {
        $this->fixture->first();
        $this->assertEquals(
            $this->values[0][0],
            $this->fixture->current()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::current
     * @depends testLastMethod
     * @uses Axstrad\Component\Collection\ObjectCollection::last
     */
    public function testCurrentMethod2()
    {
        $this->fixture->last();
        $this->assertEquals(
            $this->values[2][0],
            $this->fixture->current()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::next
     * @depends testFirstMethod
     * @uses Axstrad\Component\Collection\ObjectCollection::first
     */
    public function testNextMethod1()
    {
        $this->fixture->first();
        $this->assertEquals(
            $this->values[1][0],
            $this->fixture->next()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::next
     * @depends testLastMethod
     * @uses Axstrad\Component\Collection\ObjectCollection::last
     */
    public function testNextMethod2()
    {
        $this->fixture->last();
        $this->assertNull(
            $this->fixture->next()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::removeObject
     * @depends testOffsetExists1
     * @depends testOffsetExists2
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetExists
     * @uses Axstrad\Component\Collection\ObjectCollection::removeElement
     */
    public function testRemoveObject()
    {
        $this->fixture->removeElement($this->values[0][0]);
        $this->assertFalse(
            $this->fixture->offsetExists($this->values[0][0])
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::removeElement
     * @depends testRemoveObject
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetExists
     * @uses Axstrad\Component\Collection\ObjectCollection::removeObject
     */
    public function testRemoveElementReturnsTrueWhenObjectNotExist()
    {
        $this->assertTrue(
            $this->fixture->removeElement($this->values[0][0])
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::removeElement
     * @depends testRemoveObject
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetExists
     * @uses Axstrad\Component\Collection\ObjectCollection::removeObject
     */
    public function testRemoveElementReturnsFalseWhenObjectNotExist()
    {
        $this->assertFalse(
            $this->fixture->removeElement($this)
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::removeElement
     * @expectedException Axstrad\Component\Collection\Exception\InvalidArgumentException
     */
    public function testRemoveElementThrowsException()
    {
        $this->fixture->removeElement('Hi!');
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::getInfo
     */
    public function testGetInfoMethod()
    {
        $this->assertEquals(
            $this->values[0][1],
            $this->fixture->getInfo()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::getInfo
     * @depends testGetInfoMethod
     */
    public function testGetInfoMethodWithObject()
    {
        $this->assertEquals(
            $this->values[1][1],
            $this->fixture->getInfo($this->values[1][0])
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::getInfo
     * @dataProvider getInfoMethodReturnsNullWhenNotFoundDataProvider
     * @dependa testGetInfoMethodWithObject
     */
    public function testGetInfoMethodReturnsNullWhenNotFound($key)
    {
        $this->assertNull(
            $this->fixture->getInfo($key)
        );
    }

    public function getInfoMethodReturnsNullWhenNotFoundDataProvider()
    {
        $class = new \ReflectionObject($this);

        return array(
            array( 100 ),
            array( $class ),
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::count
     */
    public function testCountMethod()
    {
        $this->assertEquals(
            3,
            $this->fixture->count()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::offsetGet
     */
    public function testOffsetGet()
    {
        $this->assertSame(
            $this->values[2][1],
            $this->fixture->offsetGet($this->values[2][0])
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::offsetUnset
     * @depends testOffsetExists1
     * @depends testOffsetExists2
     */
    public function testOffsetUnset()
    {
        $this->fixture->offsetUnset($this->values[0][0]);
        $this->assertFalse(
            $this->fixture->offsetExists($this->values[0][0])
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::offsetSet
     * @dataProvider attachDataProvider
     * @depends testOffsetGet
     * @depends testOffsetExists1
     * @depends testOffsetExists2
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetExists
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetGet
     */
    public function testOffsetSet($object, $info)
    {
        $this->fixture->offsetSet($object, $info);

        if ($info === null) {
            $this->assertTrue(
                $this->fixture->offsetExists($object)
            );
        }
        else {
            $this->assertEquals(
                $info,
                $this->fixture->offsetGet($object)
            );
        }

    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::add
     * @dataProvider attachDataProvider
     * @depends testOffsetGet
     * @depends testOffsetSet
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetExists
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetGet
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetSet
     */
    public function testAddMethod($object, $info)
    {
        $this->fixture->add($object, $info);

        if ($info === null) {
            $this->assertTrue(
                $this->fixture->offsetExists($object)
            );
        }
        else {
            $this->assertEquals(
                $info,
                $this->fixture->offsetGet($object)
            );
        }
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::set
     * @dataProvider attachDataProvider
     * @depends testOffsetGet
     * @depends testOffsetSet
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetExists
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetGet
     * @uses Axstrad\Component\Collection\ObjectCollection::offsetSet
     */
    public function testSetMethod($object, $info)
    {
        $this->fixture->set($object, $info);

        if ($info === null) {
            $this->assertTrue(
                $this->fixture->offsetExists($object)
            );
        }
        else {
            $this->assertEquals(
                $info,
                $this->fixture->offsetGet($object)
            );
        }
    }

    public function attachDataProvider()
    {
        return array(
            array( new StdClass, null ),
            array( new StdClass, 'I\'m new' ),
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::getIterator
     */
    public function testGetIterator()
    {
        $this->assertInstanceOf(
            'Axstrad\Component\Iterator\SplObjectStorageIterator',
            $this->fixture->getIterator()
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::get
     * @dataProvider getMethodDataProvider
     * @depends testAddMethod
     * @uses Axstrad\Component\Collection\ObjectCollection::add
     */
    public function testGet($populate, $lookup, $expected)
    {
        $this->fixture->add($populate[0], $populate[1]);

        $this->assertSame(
            $expected,
            $this->fixture->get($lookup)
        );
    }

    public function getMethodDataProvider()
    {
        $object = new StdClass;
        $info = 'Hello World';

        return array(
            array( array($object, $info), $object, $info ),
            array( array($object, $info), 3, $object ),
            array( array($object, $info), new DateTime, null ),
        );
    }

    /**
     * @covers Axstrad\Component\Collection\ObjectCollection::getKeys()
     * @depends testGetIterator
     * @uses Axstrad\Component\Collection\ObjectCollection::getIterator()
     */
    public function testGetKeys()
    {
        $this->assertEquals(
            array(
                $this->values[0][0],
                $this->values[1][0],
                $this->values[2][0],
            ),
            $this->fixture->getKeys()
        );
    }

    /**
     * @depends testFirstMethod
     * @depends testCurrentMethod1
     * @depends testCurrentMethod2
     * @depends testNextMethod1
     * @depends testNextMethod2
     * @depends testGetInfoMethodWithObject
     * @uses Axstrad\Component\Collection\ObjectCollection::first
     * @uses Axstrad\Component\Collection\ObjectCollection::getInfo
     * @uses Axstrad\Component\Collection\ObjectCollection::current
     * @uses Axstrad\Component\Collection\ObjectCollection::next
     */
    public function testIteratorContainsContentsAsStorage()
    {
        $iterator = $this->fixture->getIterator();

        $iterator->rewind();
        $this->fixture->first();

        while ($iterator->valid()) {
            $this->assertEquals(
                $this->fixture->getInfo(),
                $iterator->getInfo()
            );
            $this->assertSame(
                $this->fixture->current(),
                $iterator->current()
            );

            $iterator->next();
            $this->fixture->next();
        }
    }
}
