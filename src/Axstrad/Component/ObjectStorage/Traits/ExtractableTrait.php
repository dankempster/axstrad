<?php
namespace Axstrad\Component\ObjectStorage\Traits;

use ArrayAccess;
use Closure;
use Countable;
use Doctrine\Common\Collections\Selectable;
use IteratorAggregate;

/**
 * Axstrad\Component\ObjectStorage\Traits\ExtractableTrait
 *
 * @author Dan Kempster <me@dankempster.co.uk>
 */
trait ExtractableTrait
{
    /**
     * @var integer
     */
    protected $extractFlags;

    /**
     * Sets the mode of extraction Defines what is extracted by
     *
     * @param integer $flags
     * @return self
     */
    public function setExtractFlags($flags)
    {
        $this->extractFlags = $flags;
        return $this;
    }
}
