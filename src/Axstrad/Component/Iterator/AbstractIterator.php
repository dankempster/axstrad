<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @package Axstrad\Component\Iterator
 */
namespace Axstrad\Component\Iterator;

use Axstrad\Common\Util\ClassUtil;


/**
 * Axstrad\Component\Iterator\AbstractIterator
 */
abstract class AbstractIterator implements \Iterator
{
    /**
     * @var integer|string
     */
    protected $currentKey;

    /**
     * @var mixed
     */
    protected $currentValue;


    /**
     * Class constructor
     *
     * @uses rewind To construct the object.
     */
    public function __construct()
    {
        $this->rewind();
    }

    /**
     */
    public function current()
    {
        return $this->currentValue;
    }

    /**
     */
    public function key()
    {
        return $this->currentKey;
    }

    /**
     */
    public function rewind()
    {
        $this->currentKey = -1;
        $this->currentValue = null;
    }

    /**
     */
    public function valid()
    {
        return !empty($this->currentValue);
    }
}
