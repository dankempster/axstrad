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

namespace Axstrad\Component\Content\Tests\Traits;

use Axstrad\Component\Test\TestCase;


/**
 * Axstrad\Component\Content\Tests\Traits\ArticleTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 * @subpackage Tests
 * @group unittests
 * @uses Axstrad\Component\Content\Traits\Article
 * @uses Axstrad\Component\Content\Traits\Copy
 */
class ArticleTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = $this->getMockForTrait('Axstrad\Component\Content\Traits\Article');
    }

    /**
     * covers Axstrad\Component\Content\Traits\Article::getHeading
     * covers Axstrad\Component\Content\Traits\Article::setHeading
     */
    public function testCanSetHeading()
    {
        $this->fixture->setHeading('A New Heading.');
        $this->assertEquals(
            'A New Heading.',
            $this->fixture->getHeading()
        );
    }

    /**
     * covers Axstrad\Component\Content\Traits\Article::setHeading
     */
    public function testSetHeadingReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setHeading('')
        );
    }
}
