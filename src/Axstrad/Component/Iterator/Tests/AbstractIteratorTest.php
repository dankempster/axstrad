<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @package Axstrad\Component\Iterator
 */
namespace Axstrad\Component\Iterator\Tests;


/**
 * Axstrad\Component\Iterator\Test\AbstractIteratorTest
 *
 * @group unittest
 * @uses Axstrad\Component\Iterator\AbstractIterator
 */
class AbstractIteratorTest extends \PHPUnit_Framework_TestCase
{
    protected $fixture;

    public function setUp()
    {
        $this->fixture = new AbstractIteratorTestClass();
    }

    /**
     * @covers Axstrad\Component\Iterator\AbstractIterator::__construct()
     */
    public function testExtendsIterator()
    {
        $this->assertInstanceOf('Iterator', $this->fixture);
    }

    /**
     * @covers Axstrad\Component\Iterator\AbstractIterator::key()
     */
    public function testKeyIsMinusOneBeforeIterationStart()
    {
        $this->assertEquals(
            -1,
            $this->fixture->key()
        );
    }

    /**
     * @covers Axstrad\Component\Iterator\AbstractIterator::current()
     */
    public function testCurrentIsNullBeforeIterationStart()
    {
        $this->assertNull($this->fixture->current());
    }

    /**
     * @covers Axstrad\Component\Iterator\AbstractIterator::valid()
     */
    public function testIsNotValidBeforeIterationStart()
    {
        $this->assertFalse($this->fixture->valid());
    }

    /**
     * @covers Axstrad\Component\Iterator\AbstractIterator::rewind()
     */
    public function testIteration()
    {
        $dataToIterate = array(
            "hello", "world"
        );

        $this->fixture->setTestsValueToIterate($dataToIterate);

        $this->assertNull($this->fixture->rewind());

        $this->fixture->next(); // no need to test this, it's defined on the test class

        $this->assertTrue($this->fixture->valid());
        $this->assertEquals(0, $this->fixture->key());
        $this->assertEquals('hello', $this->fixture->current());

        $this->fixture->next();

        $this->assertTrue($this->fixture->valid());
        $this->assertEquals(1, $this->fixture->key());
        $this->assertEquals('world', $this->fixture->current());

        $this->fixture->next();

        $this->assertFalse($this->fixture->valid());
    }
}
