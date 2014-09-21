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
 * Axstrad\Common\Test\Traits\TimestampTraitTest
 */
class TimestampTraitTest extends \PHPUnit_Framework_TestCase
{
    protected $fixture;
    protected $now;

    /**
     */
    public function setUp()
    {
        $this->now = new DateTime;
        $this->fixture = new TimestampTestClass($this->now);
    }

    public function testGetTimestampNoArgsReturnsDateTimeObj()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->fixture->getTimestamp()
        );
    }

    /**
     * depends testGetTimestampNoArgsReturnsDateTimeObj
     */
    public function testGetTimestampClonesInternalValueBeforeReturn()
    {
        $this->assertNotSame(
            $this->fixture->getTimestamp(),
            $this->fixture->getTimestamp()
        );
    }

    /**
     * depends testGetTimestampNoArgsReturnsDateTimeObj
     */
    public function testGetTimestampNoArgsReturnsDateTimeObjWithEqualValue()
    {
        $this->assertEquals(
            $this->now,
            $this->fixture->getTimestamp()
        );
    }

    /**
     * depends testGetTimestampNoArgsReturnsDateTimeObj
     */
    public function testGetTimestampNoArgsReturnsClonedDateTimeObj()
    {
        $this->assertNotSame(
            $this->now,
            $this->fixture->getTimestamp()
        );
    }

    /**
     *
     */
    public function testGetTimestampReturnsStringWithFormatArgument()
    {
        $this->assertInternalType(
            'string',
            $this->fixture->getTimestamp('Y-m-d')
        );
    }

    /**
     * depends testGetTimestampReturnsStringWithFormatArgument
     */
    public function testGetTimestampReturnsTimeStringWithFormatArgument()
    {
        $format = 'Y-m-d H:i:s';
        $this->assertEquals(
            $this->now->format($format),
            $this->fixture->getTimestamp($format)
        );
    }

    /**
     * depends testGetTimestampNoArgsReturnsDateTimeObjWithEqualValue
     */
    public function testSetTimestampWithDateTimeArgument()
    {
        $date = new DateTime();
        $date->modify('-1 Days');
        $this->fixture->setTimestamp($date);
        $this->assertEquals(
            $date,
            $this->fixture->getTimestamp()
        );
    }

    /**
     * depends testGetTimestampNoArgsReturnsDateTimeObjWithEqualValue
     */
    public function testSetTimestampWithStringArgument()
    {
        $string = '2001-02-03 04:05:06';
        $this->fixture->setTimestamp($string);
        $date = new DateTime($string);
        $this->assertEquals(
            $date,
            $this->fixture->getTimestamp()
        );
    }

    /**
     * depends testSetTimestampWithDateTimeArgument
     */
    public function tetsSetTimestampReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setTimestamp(new DateTime)
        );
    }

    public function testSetTimestampThrowsInvalidArgumentException()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->fixture->setTimestamp(new \StdClass);
    }
}
