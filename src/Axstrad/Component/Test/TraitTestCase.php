<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Axstrad\Component\Test;

/**
 * Axstrad\Component\Test\TraitTestCase
 *
 * Classes that use this trait must be a subclass of PHPUnit_Framework_TestCase
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license http://opensource.org/licenses/MIT MIT
 * @package Axstrad/Test
 * @subpackage TestCase
 */
abstract class TraitTestCase extends TestCase
{
    protected $trait = null;


    public function setUp()
    {
        $this->fixture = $this->getMockForTrait($this->trait);
    }
}
