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

namespace Axstrad\DoctrineExtensions\Persistence;

use Doctrine\Common\Persistence\ObjectManager;


/**
 * Axstrad\DoctrineExtensions\Persistence\ObjectManagerAwareTrait
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Persistence
 */
trait ObjectManagerAwareTrait
{
    /**
     * @var ObjectManager
     */
    protected $om;


    /**
     * @param ObjectManager $om
     * @return self
     */
    public function setObjectManager(ObjectManager $om)
    {
        $this->om = $om;
        return $this;
    }
}
