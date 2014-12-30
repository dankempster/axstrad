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


/**
 * Axstrad\DoctrineExtensions\Activatable\ActivatableTrait
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Activatable
 */
trait ActivatableTrait {

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     * @var boolean
     */
    protected $active = true;

    /**
     * Get active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param  boolean $active
     * @return self
     */
    public function setActive($active = true)
    {
        $this->active = $active === true;

        return $this;
    }
}
