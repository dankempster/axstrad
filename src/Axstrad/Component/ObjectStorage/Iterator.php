<?php
namespace Axstrad\Component\Iterator;

use Axstrad\Component\Iterator\Exception\InvalidArgumentException;
use SeekableIterator;
use SplObjectStorage;
use OutOfBoundsException;


/**
 * Axstrad\Component\Iterator\Iterator
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
    public function __construct(SplObjectStorage $storage, $extractFlags = self::EXTR_ENTRY)
    {
        $this->storage = new SplObjectStorage;
        $this->storage->addAll($storage);
        $this->setValueFlags($extractFlags);
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
        switch ($this->getValueFlags()) {
            case self::VALUE_INFO:
                $return = $this->storage->getInfo();
                break;

            case self::VALUE_OBJECT:
                $return = $this->storage->current();
                break;

            case self::VALUE_BOTH:
                $return = array(
                    'object' => $this->storage->current(),
                    'info' => $this->storage->getInfo(),
                );
                break;
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
