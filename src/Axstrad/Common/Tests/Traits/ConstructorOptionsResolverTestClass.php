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

use Axstrad\Common\Traits\ConstructorOptionsResolverTrait;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Axstrad\Common\Tests\Traits\ConstructorOptionsResolverTestClass
 */
abstract class ConstructorOptionsResolverTestClass
{
    use ConstructorOptionsResolverTrait {
        ConstructorOptionsResolverTrait::__construct as public construct;
    }

    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'foo'
        ));
    }
}
