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

namespace Axstrad\Component\Content\Traits;


/**
 * Axstrad\Bundle\ContentBundle\Traits\Article
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 */
trait Article
{
    use Copy;


    /**
     * @var string $heading the content's heading
     */
    protected $heading;

    /**
     * Set heading
     *
     * @param string $heading
     * @return self
     */
    public function setHeading($heading)
    {
        $this->heading = (string) $heading;
        return $this;
    }

    /**
     * Get heading
     *
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }
}
