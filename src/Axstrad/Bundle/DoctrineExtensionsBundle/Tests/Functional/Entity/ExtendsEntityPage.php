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

namespace Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Entity;

use Axstrad\Component\DoctrineOrm\Entity\IntegerIdTrait;
use Axstrad\DoctrineExtensions\Activatable\ActivatableEntity;
use Axstrad\DoctrineExtensions\Mapping\Annotation as Axstrad;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensionsBundle
 * @subpackage Tests
 * @Axstrad\Activatable(fieldName="active")
 * @ORM\Entity
 */
class ExtendsEntityPage extends ActivatableEntity
{
    use IntegerIdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    public $title;
}
