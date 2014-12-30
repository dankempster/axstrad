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

namespace Axstrad\Component\Content;


/**
 * Axstrad\Component\Content\Article
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 */
interface Article extends Copy
{
    /**
     * Set Heading
     *
     * @param string $heading
     * @return self
     */
    public function setHeading($heading);

    /**
     * Get Heading
     *
     * @return string
     */
    public function getHeading();
}
