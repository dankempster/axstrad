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

namespace Axstrad\Component\ObjectStorage;

use ArrayAccess;
use Closure;
use Countable;
use Doctrine\Common\Collections\Selectable;
use IteratorAggregate;

/**
 * Axstrad\Component\ObjectStorage\Extractable
 *
 * @author Dan Kempster <me@dankempster.co.uk>
 */
interface Extractable
{
    CONST EXTR_OBJECT = 0x00000001;
    CONST EXTR_INFO = 0x00000002;
    CONST EXTR_BOTH = 0x00000003;
    CONST EXTR_ENTRY = 0x00000004;

    /**
     * Sets the mode of extraction Defines what is extracted by
     *
     * @param integer $flags
     * @return self
     */
    public function setExtractFlags($flags);
}
