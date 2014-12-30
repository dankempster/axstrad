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

namespace Axstrad\Component\Content\Tests\Unit;

use Axstrad\Component\Test\TestCase;

/**
 * Axstrad\Component\Content\Tests\Unit\BaseOrmEntityTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 * @subpackage Tests
 * @group unit
 */
class BaseOrmEntityTest extends TestCase
{
    /**
     * @dataProvider fixtureProvider
     */
    public function testFixtureHasCopy($fixture)
    {
        $this->assertObjectHasAttribute(
            'copy',
            $fixture
        );
    }

    /**
     * @dataProvider fixtureProvider
     */
    public function testFixtureGetIdReturnsNull($fixture)
    {
        $this->assertNull($fixture->getId());
    }

    public function fixtureProvider()
    {
        return array(
            [$this->getMockForAbstractClass('Axstrad\Component\Content\Orm\Copy')],
            [$this->getMockForAbstractClass('Axstrad\Component\Content\Orm\Article')]
        );
    }

    /**
     * @dataProvider headingFixtureProvider
     */
    public function testFixtureHasHeading($fixture)
    {
        $this->assertObjectHasAttribute(
            'heading',
            $fixture
        );
    }

    public function headingFixtureProvider()
    {
        return array(
            [$this->getMockForAbstractClass('Axstrad\Component\Content\Orm\Article')]
        );
    }
}
