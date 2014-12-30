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

namespace Axstrad\Common\Traits;

/**
 * Axstrad\Common\Traits\NameTrait
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Common
 * @subpackage Traits
 */
trait NameTrait
{
    /**
     * @var string
     */
    protected $name;


    /**
     * Get name
     *
     * @return string
     * @see setName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     * @see getName
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }
}
