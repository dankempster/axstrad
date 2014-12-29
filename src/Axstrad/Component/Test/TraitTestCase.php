<?php
namespace Axstrad\Component\Test;


/**
 * Axstrad\Component\Test\TraitTestCase
 *
 * Classes that use this trait must be a subclass of PHPUnit_Framework_TestCase
 */
abstract class TraitTestCase extends TestCase
{
    protected $trait = null;


    public function setUp()
    {
        $this->fixture = $this->getMockForTrait($this->trait);
    }
}
