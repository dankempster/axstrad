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
     * covers Axstrad\Component\Content\Traits\Copy::getCopy
     * covers Axstrad\Component\Content\Traits\Copy::setCopy
     */
    public function testCanSetCopy()
    {
        $this->fixture->setCopy('Some more copy.');
        $this->assertEquals(
            'Some more copy.',
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
}
