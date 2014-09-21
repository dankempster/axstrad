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
 * @package Axstrad\Common
 * @subpackage Traits
 */
namespace Axstrad\Common\Tests\Traits;

use DateTime;

/**
 * Axstrad\Common\Test\Traits\TimestampableTraitTest
 *
 * @uses Axstrad\Common\Traits\TimestampableTrait
 * @uses Axstrad\Common\Traits\TimestampTrait
 */
class TimestampableTraitTest extends \PHPUnit_Framework_TestCase
{
    protected $fixture;

    /**
     */
    public function setUp()
    {
        $this->fixture = new TimestampableTestClass();
    }

    /**
     * @covers Axstrad\Common\Traits\TimestampableTrait::getTimestamp
     */
    public function testGetTimestampReturnsOptionNoneWithNoTimestamp()
    {
        $this->assertInstanceOf(
            'PhpOption\None',
            $this->fixture->getTimestamp()
        );
    }

    /**
     * @covers Axstrad\Common\Traits\TimestampableTrait::getTimestamp
     */
    public function testGetTimestampReturnsOptionNoneWithNoTimestampAndFormateArgument()
    {
        $this->assertInstanceOf(
            'PhpOption\None',
            $this->fixture->getTimestamp('')
        );
    }

    /**
     * @covers Axstrad\Common\Traits\TimestampableTrait::setTimestamp
     */
    public function testSetTimestampReturnsPhpOptionSomeObject()
    {
        $this->fixture->setTimestamp(new DateTime);
        $this->assertInstanceOf(
            'PhpOption\Option',
            $this->fixture->getTimestamp()
        );
    }

    /**
     * @depends testSetTimestampReturnsPhpOptionSomeObject
     * @covers Axstrad\Common\Traits\TimestampableTrait::setTimestamp
     */
    public function testSetTimestampDateTimeArgumentReturnsCorrectValue()
    {
        $this->fixture->setTimestamp($data = new DateTime('2001-02-03 04:05:06'));
        $this->assertEquals(
            $data,
            $this->fixture->getTimestamp()->get()
        );
    }


    /**
     * @depends testSetTimestampReturnsPhpOptionSomeObject
     * @covers Axstrad\Common\Traits\TimestampableTrait::setTimestamp
     */
    public function testSetTimestampStringArgumentReturnsCorrectValue()
    {
        $string = '2001-02-03 04:05:06';
        $this->fixture->setTimestamp($string);
        $this->assertEquals(
            new DateTime($string),
            $this->fixture->getTimestamp()->get()
        );
    }

    /**
     * @depends testGetTimestampReturnsOptionNoneWithNoTimestamp
     * @depends testSetTimestampDateTimeArgumentReturnsCorrectValue
     * @covers Axstrad\Common\Traits\TimestampableTrait::setTimestamp
     */
    public function testSetTimestampAcceptsNull()
    {
        $this->fixture->setTimestamp(new DateTime);
        $this->fixture->setTimestamp(null);
        $this->assertInstanceOf(
            'PhpOption\None',
            $this->fixture->getTimestamp()
        );
    }

    /**
     * @depends testSetTimestampDateTimeArgumentReturnsCorrectValue
     * @covers Axstrad\Common\Traits\TimestampableTrait::getTimestamp
     */
    public function testGetTimestampReturnsStringIfFormatArgument()
    {
        $this->fixture->setTimestamp(new DateTime);

        $this->assertInternalType(
            'string',
            $this->fixture->getTimestamp('')
        );
    }

    /**
     * @depends testSetTimestampDateTimeArgumentReturnsCorrectValue
     * @covers Axstrad\Common\Traits\TimestampableTrait::setTimestamp
     */
    public function testSomeOptionHasCorrectDateTimeObject()
    {
        $now = new DateTime;
        $this->fixture->setTimestamp($now);
        $this->assertEquals(
            $now,
            $this->fixture->getTimestamp()->get()
        );
    }
}
