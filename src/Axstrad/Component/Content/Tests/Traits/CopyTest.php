<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\Component\Content\Tests\Content\Traits;

use Axstrad\Component\Test\TestCase;

/**
 * Axstrad\Component\Content\Tests\Content\Traits\CopyTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 * @subpackage Tests
 * @group unittests
 * @uses Axstrad\Component\Content\Traits\Copy
 */
class CopyTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = $this->getMockForTrait('Axstrad\Component\Content\Traits\Copy');
    }

    /**
     */
    public function testCopyIsNullToStart()
    {
        $this->assertAttributeNull(
            'copy',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\Component\Content\Traits\Copy::getCopy
     * @depends testCopyIsNullToStart
     */
    public function testGetCopyMethod1()
    {
        $this->assertNull(
            $this->fixture->getCopy()
        );
    }

    /**
     */
    public function testCanSetCopy()
    {
        $this->fixture->setCopy('Some more copy.');
        $this->assertEquals(
            'Some more copy.',
            'copy',
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\Component\Content\Traits\Copy::getCopy
     * @uses Axstrad\Component\Content\Traits\Copy::setCopy
     * @depends testCanSetCopy
     */
    public function testGetCopyMethod2()
    {
        $this->fixture->setCopy('My copy');
        $this->assertEquals(
            'My copy',
            $this->fixture->getCopy()
        );
    }

    /**
     * covers Axstrad\Component\Content\Traits\Copy::setCopy
     */
    public function testSetCopyReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setCopy('foo')
        );
    }

    /**
     * covers Axstrad\Component\Content\Traits\Copy::setCopy
     * @depends testCanSetCopy
     */
    public function testCopyIsTypeCastToString()
    {
        $this->fixture->setCopy(1.1);
        $this->assertSame(
            '1.1',
            $this->fixture->getCopy()
        );
    }
    /**
     * @covers Axstrad\Component\Content\Traits\Copy::setCopy
     * @depends testCanSetCopy
     */
    public function testCopyCanBeSetToNull()
    {
        $this->fixture->setCopy('My Copy');
        $this->fixture->setCopy(null);
        $this->assertAttributeEquals(
            null,
            'copy',
            $this->fixture
        );
    }
}
