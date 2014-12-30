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
 * Axstrad\Common\Traits\TitleTrait
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Common
 * @subpackage Traits
 */
trait TitleTrait
{
    /**
     * @var string
     */
    protected $title;


    /**
     * Get title
     *
     * @return string
     * @see setTitle
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     * @see getTitle
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;
        return $this;
    }
}
