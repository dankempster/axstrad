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
namespace Axstrad\Common\Tests\Util\StrUtil;

use Axstrad\Common\Util\StrUtil;


/**
 * Axstrad\Common\Tests\Util\StrUtil\EllipseTest
 *
 * covers Axstrad\Common\Util\StrUtil::ellipse
 * @group unittests
 */
class EllipseTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsStringWhenShorterThenMaxLength()
    {
        $this->assertEquals(
            "Hello World",
            StrUtil::ellipse(
                "Hello World",
                20
            )
        );
    }

    public function testReturnsTruncatedStringWithEllipse()
    {
        $this->assertEquals(
            "Hello Worl...",
            StrUtil::ellipse(
                "Hello World",
                10
            )
        );
    }
}
