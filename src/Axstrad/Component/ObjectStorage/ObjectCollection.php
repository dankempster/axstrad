<?php
namespace Axstrad\Component\ObjectStorage;


use ArrayIterator;
use Axstrad\Common\Util\Debug;
use Axstrad\Component\ObjectStorage\Exception\InvalidArgumentException;
use Axstrad\Component\Iterator\SplObjectStorageIterator;
use Closure;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use Doctrine\Common\Collections\Selectable;
use OutOfBoundsException;
use SplObjectStorage;


/**
 * Axstrad\Component\ObjectStorage\ObjectCollection
 *
 * An ObjectCollection is a Collection implementation that wraps an SplObjectStorage instance.
 *
 * This class is based on Doctrine\Common\Collections\ArrayCollection developed
 * by
 *     - Guilherme Blanco <guilhermeblanco@hotmail.com>
 *     - Jonathan Wage <jonwage@gmail.com>
 *     - Roman Borschel <roman@code-factory.org>
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 */
class ObjectCollection implements
    Collection
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
     * @param SplObjectStorage|array array $objects
     */
    public function __construct($objects = array())
    {
        $this->storage = new SplObjectStorage;

        if (empty($objects)) return;

        if (!$objects instanceof SplObjectStorage) {
            $objects = new SplObjectStorage($objects);
        }
        $this->storage->addAll($objects);
    }

    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array[]
     */
    public function toArray()
    {
        $array = array();
        $iterator = $this->getIterator();
        foreach ($iterator as $object) {
            $array[] = array(
                'object' => $object,
                'info' => $iterator->getInfo(),
            );
        }
        return $array;
    }

    /**
     * Sets the internal iterator to the first object in the collection and
     * returns this element.
     *
     * @return object
     */
    public function first()
    {
        $this->storage->rewind();
        return $this->getIterator()->current();
    }

    /**
     * Sets the internal iterator to the last object in the collection and
     * returns it.
     *
     * @return object
     * @uses current To return the current object
     */
    public function last()
    {
        // Iterate to the end
        $count = $this->storage->count() - 1;
        while ($this->storage->key() < $count) {
            $this->storage->next();
        }

        return $this->storage->current();
    }

    /**
     * Gets the index of the object at the current iterator position.
     *
     * @return integer
     */
    public function key()
    {
        return $this->storage->key();
    }

    /**
     * Gets the object of the collection at the current iterator position.
     *
     * @return object
     */
    public function current()
    {
        return $this->storage->current();
    }

    /**
     * Moves the internal iterator position to the next object and returns it.
     *
     * @return object
     * @uses current To return the current object
     */
    public function next()
    {
        $this->storage->next();
        return $this->current();
    }

    /**
     * Removes the specified object or the object at the specified index from
     * the collection.
     *
     * @param integer|object $key The object or index of the object to be
     *        removed.
     * @return null|array The removed object and info or null if the collection
     *         did not contain the element.
     * @uses removeObject To remove the object.
     */
    public function remove($key)
    {
        if (is_object($key)) {
            return $this->removeObject($key);
        }

        $iterator = $this->getIterator();
        $iterator->seek($key);
        return $this->removeObject($iterator->current());
    }


    /**
     * Removes the specified object from the collection.
     *
     * @param object $object The object to be removed.
     * @return boolean True if this collection contained the specified object,
     *         false otherwise.
     * @uses removeObject To remove the object
     * @throws InvalidArgumentException If $object is not an object
     */
    public function removeElement($object)
    {
        if (!is_object($object)) {
            throw new InvalidArgumentException(
                sprintf('Expected object, got %s', Debug::summarise($object)).
                '. Tip: Use remove() to remove an object by index (or object).'
            );
        }

        return $this->removeObject($object) !== null;
    }

    /**
     * Removes an object from the collection.
     *
     * This method assumes $obect has already been asserted to be an object.
     *
     * @param object $object The object to remove
     * @return null|array The removed object and info or null if the collection
     *         did not contain the element.
     */
    private function removeObject($object)
    {
        if ($this->contains($object)) {
            $removed = $this->getInfo($object);
            $this->storage->detach($object);
            return array(
                'object' => $object,
                'info' => $removed,
            );
        }
        return null;
    }

    /**
     * Returns the data associated
     *
     * With either the current iterator entry or $object if it is not null.
     *
     * @param null|integer|object $key
     * @return mixed The info if $key exists, null otherwise
     * @uses contains To test if $key is within the collection
     * @uses getIterator To seek the storage if $key is not NULL
     */
    public function getInfo($key = null)
    {
        if ($key !== null) {
            $iterator = $this->getIterator();
            try {
                $iterator->seek($key);
                return $iterator->getInfo();
            }
            catch (OutOfBoundsException $e) {
                return null;
            }
        }

        return $this->storage->getInfo();
    }

    /**
     * Sets the data associated with the current iterator entry
     *
     * @param mixed $info
     * @param null|object $object = null
     * @return self
     * @uses offsetSet If $object is not null
     */
    public function setInfo($info, $object = null)
    {
        if ($object === null) {
            return $this->storage->setInfo($info);
        }

        return $this->offsetSet($object, $info);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritDoc}
     */
    public function offsetExists($object)
    {
        return $this->storage->offsetExists($object);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritDoc}
     */
    public function offsetGet($object)
    {
        return $this->storage->offsetGet($object);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * @param object $object The offset
     * @param mixed $info The info to store with $object
     */
    public function offsetSet($object, $info = null)
    {
        return $this->storage->offsetSet($object, $info);
    }

    /**
     * Remove an object from the collection
     *
     * @param object $object The object to remove
     * @return void
     */
    public function offsetUnset($object)
    {
        $this->storage->offsetUnset($object);
    }

    /**
     * Checks whether the collection contains the specified index/object.
     *
     * @param integer|object $key The index/object to check for.
     * @return boolean True if the collection the specified index/object,
     *                 FALSE otherwise.
     * @uses contains If $key is an object
     * @uses getIterator To seek the storage if $key is an integer
     */
    public function containsKey($key)
    {
        if (is_object($key)) {
            return $this->contains($key);
        }

        $iterator = $this->getIterator();
        $iterator->seek($key);
        return $iterator->valid();
    }

    /**
     * Checks whether the colleciton contains the specified info
     *
     * @param mixed $info
     * @return boolean True if the collection contains the info, false otherwise
     */
    public function containsInfo($info)
    {
        $iterator = $this->getIterator();
        foreach ($iterator as $object) {
            if ($iterator->getInfo() === $info) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks whether an object is contained in the collection.
     *
     * @param object $object The object to search for.
     * @return boolean True if the collection contains the element, false
     *         otherwise.
     */
    public function contains($object)
    {
        return $this->storage->contains($object);
    }

    /**
     * Tests for the existence of an object and/or info that satisfies the given
     * predicate.
     *
     * The preficate closure will receive three arguments
     *  - index
     *  - object
     *  - info
     *
     * @param Closure $p The predicate.
     * @return boolean True if the predicate is true for at least one element,
     *         false otherwise.
     */
    public function exists(Closure $p)
    {
        $iterator = $this->getIterator();
        foreach ($iterator as $index => $object) {
            if ($p($index, $object, $iterator->getInfo())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Gets the index/object of a given object/info.
     *
     * @param mixed $lookup The object/info to search for.
     * @return intger|bool The index of $lookup or false if $lookup was not
     *         found.
     */
    public function indexOf($lookup)
    {
        $iterator = $this->getIterator();
        foreach ($iterator as $index => $object) {
            if ($lookup === $object || $lookup === $iterator->getInfo()) {
                return $index;
            }
        }
        return false;
    }

    /**
     * @param integer|object $key
     * @return mixed If $key is an index, the object it references is returned.
     *         If $key is an object then object's info is returned.
     *         Null is returned if $key is not within the collection.
     */
    public function get($key)
    {
        if (is_numeric($key)) {
            $iterator = $this->getIterator();
            $iterator->seek($key);
            return $iterator->current();
        }
        elseif (is_object($key) && isset($this->storage[$key])) {
            return $this->storage[$key];
        }
        return null;
    }

    /**
     * Gets all indicies/objects of the collection.
     *
     * @param boolean $returnObjects Return the objects instead of the indicies.
     * @return integer[]|object[]
     * @uses getObjects
     * @see getValues
     */
    public function getKeys($objects = false)
    {
        if ($objects) {
            return $this->getObjects();
        }

        $keys = array();
        foreach ($this as $key => $object) {
            $keys[] = $key;
        }
        return $keys;
    }

    /**
     * Returns the info stored with each object.
     *
     * @see getKeys
     * @see getObjects
     * @uses getIterator
     */
    public function getValues()
    {
        $iterator = $this->getIterator();
        $info = array();
        foreach ($iterator as $object) {
            $info[] = $iterator->getInfo();
        }
        return $info;
    }

    /**
     * @return array
     */
    public function getObjects()
    {
        return iterator_to_array($this);
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return $this->storage->count();
    }

    /**
     * Sets an object and info in the collection.
     *
     * Warning: This method breaks BC with Collection interface. Parameter one,
     * according to the interface, should be a string or interger; But that's
     * not how SplObjectStorage works. So for this collection parameter one is
     * of type object.
     *
     * @param object $object The object to store
     * @param mixed $info The info to store with the object
     * @return void
     * @uses offsetSet This method exists to satisfy the
     *       Doctrine\Common\Collections\Collection interface
     * @see add
     */
    public function set($object, $info)
    {
        $this->offsetSet($object, $info);
    }

    /**
     * Add an object (and optionally info) in the collection.
     *
     * Warning: This method breaks BC with Collection interface. Parameter one,
     * according to the interface, should be a string or interger; But that's
     * not how SplObjectStorage works. So for this collection parameter one is
     * of type object.
     *
     * @param object $object The object to store
     * @param mixed $info The info to store with the object
     * @return void
     * @uses offsetSet This method exists to satisfy the
     *       Doctrine\Common\Collections\Collection interface
     * @see set
     */
    public function add($object, $info = null)
    {
        $this->offsetSet($object, $info);
        return true;
    }

    /**
     * Checks whether the collection is empty (contains no objects).
     *
     * @return boolean True if the collection is empty, False otherwise.
     */
    public function isEmpty()
    {
        return $this->count() == 0;
    }

    /**
     * Required by interface IteratorAggregate.
     *
     * {@inheritDoc}
     *
     * @return SplObjectStorageItrerator
     */
    public function getIterator()
    {
        return new SplObjectStorageIterator($this->storage);
    }

    /**
     * Applies the given function to each element in the collection and returns
     * a new collection with the elements returned by the function.
     *
     * @param Closure $func
     *
     * @return ObjectCollection
     */
    public function map(Closure $func)
    {
        return new static(array_map($func, $this->storage));
    }

    /**
     * {@inheritDoc}
     */
    public function filter(Closure $p)
    {
        return new static(array_filter($this->storage, $p));
    }

    /**
     * {@inheritDoc}
     */
    public function forAll(Closure $p)
    {
        $iterator = $this->getIterator();
        foreach ($iterator as $index => $object) {
            if ( ! $p($index, $object, $iterator->getInfo())) {
                return false;
            }
        }

        return true;
    }

    /**
     * Partitions this collection in two collections according to a predicate.
     * Keys are preserved in the resulting collections.
     *
     * @param Closure $p The predicate on which to partition.
     *
     * @return array An array with two elements. The first element contains the collection
     *               of elements where the predicate returned TRUE, the second element
     *               contains the collection of elements where the predicate returned FALSE.
     */
    public function partition(Closure $p)
    {
        $iterator = $this->getIterator();
        $coll1 = new SplObjectStorage;
        $coll2 = new SplObjectStorage;
        foreach ($iterator as $index => $object) {
            $info = $iterator->getInfo();
            if ($p($index, $object, $info)) {
                $coll1[$object] = $info;
            } else {
                $coll2[$object] = $info;
            }
        }
        return array(new static($coll1), new static($coll2));
    }

    /**
     * Returns a string representation of this object.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . '@' . spl_object_hash($this);
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->storage->removeAll($this);
    }

    /**
     * Extracts a slice of $length elements starting at position $offset from the Collection.
     *
     * If $length is null it returns all elements from $offset to the end of the Collection.
     * Keys have to be preserved by this method. Calling this method will only return the
     * selected slice and NOT change the elements contained in the collection slice is called on.
     *
     * @param int      $offset The offset to start from.
     * @param int|null $length The maximum number of elements to return, or null for no limit.
     *
     * @return array
     */
    public function slice($offset, $length = null)
    {
        return array_slice($this->toArray(), $offset, $length, true);
    }

    /**
     * Selects all elements from a selectable that match the expression and
     * returns a new ObjectCollection containing these elements.
     *
     * @param Criteria $criteria
     *
     * @return ObjectCollection
     */
    public function matching(Criteria $criteria)
    {
        $expr     = $criteria->getWhereExpression();
        $filtered = $this->storage;

        if ($expr) {
            $visitor  = new ClosureExpressionVisitor();
            $filter   = $visitor->dispatch($expr);
            $filtered = array_filter($filtered, $filter);
        }

        if ($orderings = $criteria->getOrderings()) {
            $next = null;
            foreach (array_reverse($orderings) as $field => $ordering) {
                $next = ClosureExpressionVisitor::sortByField($field, $ordering == 'DESC' ? -1 : 1, $next);
            }

            usort($filtered, $next);
        }

        $offset = $criteria->getFirstResult();
        $length = $criteria->getMaxResults();

        if ($offset || $length) {
            $filtered = array_slice($filtered, (int)$offset, $length);
        }

        return new static($filtered);
    }
}
