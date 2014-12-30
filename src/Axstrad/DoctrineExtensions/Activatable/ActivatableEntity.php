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

namespace Axstrad\DoctrineExtensions\Activatable;

use Doctrine\ORM\Mapping as ORM;
use Axstrad\DoctrineExtensions\Mapping\Annotation as Axstrad;


/**
 * Axstrad\DoctrineExtensions\Activatable\ActivatableEntity
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Activatable
 * @Axstrad\Activatable(fieldName="active")
 * @ORM\MappedSuperclass
 */
class ActivatableEntity
{
    use ActivatableTrait;
}
