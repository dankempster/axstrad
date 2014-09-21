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


/**
 * Axstrad\Common\Tests\Traits\OptionsResolverTraitTest
 *
 * @covers Axstrad\Common\Traits\OptionsResolverTrait::resolveOptions
 */
class OptionsResolverTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testInvokesConfigureOptionsWithOptionsResolver()
    {
        $mock = $this->getMockForAbstractClass(__NAMESPACE__.'\OptionsResolverAbstractTestClass');
        $mock->expects($this->once())
             ->method('configureOptions')
             ->with($this->equalTo(new \Symfony\Component\OptionsResolver\OptionsResolver))
        ;

        $mock->resolveOptions(array());
    }

    /**
     * @depends testInvokesConfigureOptionsWithOptionsResolver
     * @expectedException Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     */
    public function testThrowsExceptionWhenMissingOption()
    {
        $fixture = new OptionsResolverTestClass();
        $fixture->resolveOptions(array());
    }

    /**
     * @depends testInvokesConfigureOptionsWithOptionsResolver
     * @expectedException Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testThrowsExceptionForUnexpectedOption()
    {
        $fixture = new OptionsResolverTestClass();
        $fixture->resolveOptions(array('hello' => 'world'));
    }

    /**
     * @depends testInvokesConfigureOptionsWithOptionsResolver
     */
    public function testReturnsResolvedOptions()
    {
        $fixture = new OptionsResolverTestClass();

        $options = array('foo' => 'hello world');

        $this->assertEquals(
            $options,
            $fixture->resolveOptions($options)
        );
    }
}
