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

namespace Axstrad\DoctrineExtensions\Mapping\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Axstrad\DoctrineExtensions\Mapping\Annotation\Activatable
 *
 * Group annotation for Activatable extension
 *
 * @Annotation
 * @Target("CLASS")
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Activatable
 */
final class Activatable extends Annotation
{
    /**
     * @var string
     */
    public $fieldName = 'active';
}
