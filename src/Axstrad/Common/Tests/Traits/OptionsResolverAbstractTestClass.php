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

use Axstrad\Common\Traits\OptionsResolverTrait;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Axstrad\Common\Tests\Traits\OptionsResolverAbstractTestClass
 */
abstract class OptionsResolverAbstractTestClass
{
    use OptionsResolverTrait {
        OptionsResolverTrait::resolveOptions as public;
    }
}
