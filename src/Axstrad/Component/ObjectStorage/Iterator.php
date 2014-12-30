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

use Axstrad\Component\Iterator\Exception\InvalidArgumentException;
use Axstrad\Component\ObjectStorage\Exception\InvalidExtractFlagException;
use OutOfBoundsException;
use SeekableIterator;
use SplObjectStorage;


/**
 * Axstrad\Component\ObjectStorage\Iterator
 *
 * An iterator to iterate SplObjectStorage objects with the ability to decide
 * how data is extract and present during iteratrion.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 */
class Iterator implements
    Extractable,
    SeekableIterator
{
    use Traits\ExtractableTrait;


    /**
     * An array containing the entries of this collection.
     *
     * @var SplObjectStorage
     */
    private $storage;


    /**
     * Initializes a new ArrayCollection.
     *
     * @param SplObjectStorage $storage
     */
    public function __construct(SplObjectStorage $storage, $extractFlags = self::EXTR_OBJECT)
    {
        $this->storage = new SplObjectStorage;
        $this->storage->addAll($storage);
        $this->setExtractFlags($extractFlags);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->storage->key();
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        return $this->storage->next();
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        switch ($this->extractFlags) {
            case self::EXTR_INFO:
                $return = $this->storage->getInfo();
                break;

            case self::EXTR_OBJECT:
                $return = $this->storage->current();
                break;

            case self::EXTR_BOTH:
                $return = array(
                    'object' => $this->storage->current(),
                    'info' => $this->storage->getInfo(),
                );
                break;
            default:
                throw InvalidExtractFlagException::create(
                    $this->extractFlags,
                    $this
                );
        }
        return $return;
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        return $this->storage->rewind();
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return $this->storage->valid();
    }

    /**
     * Returns the data associated with the current iterator entry
     *
     * @return mixed
     */
    public function getInfo()
    {
        return $this->storage->getInfo();
    }

    /**
     * Seeks to a position
     *
     * Seeks to a given position in the iterator.
     *
     * @param integer|object $position
     * @return void
     * @throws OutOfBoundsException If $position is invalid
     */
    public function seek($position)
    {
        $this->rewind();
        while ($this->valid()) {
            if ((is_numeric($position) && $this->key() == $position) ||
                ($this->current() === $position)
            ) {
                return;
            }
            $this->next();
        }
        throw new OutOfBoundsException(
            "Position '{$position}' is invalid"
        );
    }
}
