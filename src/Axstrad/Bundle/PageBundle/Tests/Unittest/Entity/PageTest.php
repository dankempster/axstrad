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

namespace Axstrad\Bundle\PageBundle\Tests\Unittest\Entity;

use Axstrad\Bundle\PageBundle\Entity\Page;

/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage Tests
 */
class PageTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->fixture = new Page;
    }

    public function testHeading()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setHeading('heading'),
            'setHeading() doesn\'t return self.'
        );

        $this->assertEquals(
            'heading',
            $this->fixture->getHeading()
        );
    }

    public function testCopy()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->setCopy('copy'),
            'setCopy() doesn\'t return self.'
        );

        $this->assertEquals(
            'copy',
            $this->fixture->getCopy()
        );
    }
}
