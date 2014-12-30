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
 * Axstrad\Common\Traits\NullableNameTrait
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Common
 * @subpackage Traits
 */
trait NullableNameTrait
{
    use NameTrait;


    /**
     * Set name
     *
     * @param null|string $name
     * @return self
     * @see getTitle
     */
    public function setName($name = null)
    {
        if ($name === null) {
            $this->name = null;
        }
        else {
            $this->name = (string) $name;
        }
        return $this;
    }
}
