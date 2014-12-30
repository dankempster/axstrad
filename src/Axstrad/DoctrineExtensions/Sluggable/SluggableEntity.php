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

namespace Axstrad\DoctrineExtensions\Sluggable;

use Doctrine\ORM\Mapping as ORM;


/**
 * Axstrad\DoctrineExtensions\Sluggable\SluggableEntity
 *
 * Provides the following fields
 *  - slug : string  - unique index
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Sluggable
 * @ORM\MappedSuperclass()
 */
class SluggableEntity implements
    Sluggable
{
    use SluggableTrait;
}
