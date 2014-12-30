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
 * An SplObjectStorage decorator for an ObjectCollection.
 *
 * This decorator provides a similar interface for the SplObjectStorage class to
 * what Doctrine\Common\Collections\Collection provides for PHP arrays. Before
 * I get into that, I'll describe the differences between how a PHP Array (array)
 * and an SplObjectStorage object (storage) behave.
 *
 * Arrays provide the association of data to a unique key, the Storage
 * provides the association of data to an object; And the object is the unique
 * key. So array access with Storage uses the object as the key and the value
 * as the object's info. Examples to demonstrate
 *
 * // Array
 * $array[] = $object1;
 * $array['key'] = $object2;
 *
 * // Storage
 * $storage[$object1] = 'Info';
 * $storage[$object2] = null;
 *
 * You'll probably now be expecting that when iterating Storage the key would
 * be the object and the value the object's info. Unfortunately, that's not the
 * case. It seems PHP's internal iterator doesn't allow non-scalar keys.
 * So the key is numeric (an index) and the value is the object and to access
 * the info you'd call {@see getInfo() getInfo}. For example:
 *
 * foreach ($storage as $index => $object) {
 *     $info = $storage->getInfo();
 *     // ...
 * }
 *
 *
 *
 * To start to describe how this interface differs from the
 * Doctrine\Common\Collections\Collection interface (of which this is based on)
 * I'll first quote the upstream developers.
 *
 *     "A Collection has an internal iterator just like a PHP array. In
 *     addition, a Collection can be iterated with external iterators, which is
 *     preferrable. To use an external iterator simply use the foreach language
 *     construct to iterate over the collection (which calls getIterator()
 *     internally) or explicitly retrieve an iterator though getIterator() which
 *     can then be used to iterate over the collection."
 *         - Guilherme Blanco <guilhermeblanco@hotmail.com>,
 *           Jonathan Wage <jonwage@gmail.com> and
 *           Roman Borschel <roman@code-factory.org>
 *
 * Due to how a Storage is forced to behave during iteration, to get the
 * object's info you need access to the iterator. So to use an external
 * iterator you'd have to fetch the iterator first and use that in the foreach.
 * An example to demonstrate:
 *
 * // External Iterator - The Doctrine way
 * $storage = new ObjectStorage();
 * $storage->attach(new StdClass, 'Object 1');
 * $storage->attach(new StdClass, 'Object 2');
 * $storage->attach(new StdClass, 'Object 3');
 *
 * foreach ($storage as $index => $object) { // foreach calls $storage->getIterator() to get an external iterator
 *     echo $storage->getInfo()."\n";
 * }
 * $iterator = $storage->getIterator();
 * foreach ($iterator as $index => $object) {
 *     echo $iterator->getInfo()."\n"
 * }
 *
 * // Outputs:
 * // Object 1
 * // Object 1
 * // Object 1
 * // Object 1
 * // Object 2
 * // Object 3
 *
 * // Internal iterator
 * //  - Same $storage set up as previous
 *
 * foreach ($storage as $index => $object) { // foreach calls $storage->getIterator(), $storage returns self
 *     echo $storage->getInfo()."\n";
 * }
 * $iterator = $storage->getIterator();
 * foreach ($storage as $index => $object) {
 *     echo $storage->getInfo()."\n";
 * }
 *
 * // Outputs:
 * // Object 1
 * // Object 2
 * // Object 3
 * // Object 1
 * // Object 2
 * // Object 3
 *
 * So to keep things simple I've made the interface use an internal iterator for
 * foreach loops; But the upstream devs do continue to say
 *
 *     "You can not rely on the internal iterator of the collection being at a
 *     certain position unless you explicitly positioned it before. Prefer
 *     iteration with external iterators."
 *
 * And I agree. Generally I prefer external iteration but I want to keep thing
 * simple. I don't want to be calling {@see getIterator() getIterator()} each
 * time I need to iterate and get the object's info. This does mean there are
 * some methods that are unsafe to use, during iteration.
 * For example, {@see first() first()} which would {@see rewind() rewind} the
 * internal iterator pointer. Which is (most likely) the  last thing you want
 * and would likely cause an infinite loop.
 *
 * To combat that, unsafe methods (those that would change the internal
 * iterators position) have the option to be "safe"; By using the class constant
 * IOSOLATE as a method flag. If an unsafe method receives the ISOLATE flag it
 * will use an external iterator instead.
 *
 * @author Dan Kempster <me@dankempster.co.uk>
 */
interface ObjectCollectionInterface extends
    ArrayAccess,
    Countable,
    Extractable,
    Iterator,
    Selectable
{
    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $element The element to add.
     *
     * @return boolean Always TRUE.
     */
    function add($element);

    /**
     * Clears the collection, removing all elements.
     *
     * @return void
     */
    function clear();

    /**
     * Checks whether an element is contained in the collection.
     * This is an O(n) operation, where n is the size of the collection.
     *
     * @param mixed $element The element to search for.
     *
     * @return boolean TRUE if the collection contains the element, FALSE otherwise.
     */
    function contains($element);

    /**
     * Checks whether the collection is empty (contains no elements).
     *
     * @return boolean TRUE if the collection is empty, FALSE otherwise.
     */
    function isEmpty();

    /**
     * Removes the element at the specified index from the collection.
     *
     * @param string|integer $key The kex/index of the element to remove.
     *
     * @return mixed The removed element or NULL, if the collection did not contain the element.
     */
    function remove($key);

    /**
     * Removes the specified element from the collection, if it is found.
     *
     * @param mixed $element The element to remove.
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    function removeElement($element);

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param string|integer $key The key/index to check for.
     *
     * @return boolean TRUE if the collection contains an element with the specified key/index,
     *                 FALSE otherwise.
     */
    function containsKey($key);

    /**
     * Gets the element at the specified key/index.
     *
     * @param string|integer $key The key/index of the element to retrieve.
     *
     * @return mixed
     */
    function get($key);

    /**
     * Gets all keys/indices of the collection.
     *
     * @return array The keys/indices of the collection, in the order of the corresponding
     *               elements in the collection.
     */
    function getKeys();

    /**
     * Gets all values of the collection.
     *
     * @return array The values of all elements in the collection, in the order they
     *               appear in the collection.
     */
    function getValues();

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param string|integer $key   The key/index of the element to set.
     * @param mixed          $value The element to set.
     *
     * @return void
     */
    function set($key, $value);

    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array
     */
    function toArray();

    /**
     * Sets the internal iterator to the first element in the collection and returns this element.
     *
     * @return mixed
     */
    function first();

    /**
     * Sets the internal iterator to the last element in the collection and returns this element.
     *
     * @return mixed
     */
    function last();

    /**
     * Gets the key/index of the element at the current iterator position.
     *
     * @return int|string
     */
    function key();

    /**
     * Gets the element of the collection at the current iterator position.
     *
     * @return mixed
     */
    function current();

    /**
     * Moves the internal iterator position to the next element and returns this element.
     *
     * @return mixed
     */
    function next();

    /**
     * Tests for the existence of an element that satisfies the given predicate.
     *
     * @param Closure $p The predicate.
     *
     * @return boolean TRUE if the predicate is TRUE for at least one element, FALSE otherwise.
     */
    function exists(Closure $p);

    /**
     * Returns all the elements of this collection that satisfy the predicate p.
     * The order of the elements is preserved.
     *
     * @param Closure $p The predicate used for filtering.
     *
     * @return Collection A collection with the results of the filter operation.
     */
    function filter(Closure $p);

    /**
     * Tests whether the given predicate p holds for all elements of this collection.
     *
     * @param Closure $p The predicate.
     *
     * @return boolean TRUE, if the predicate yields TRUE for all elements, FALSE otherwise.
     */
    function forAll(Closure $p);

    /**
     * Applies the given function to each element in the collection and returns
     * a new collection with the elements returned by the function.
     *
     * @param Closure $func
     *
     * @return Collection
     */
    function map(Closure $func);

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
    function partition(Closure $p);

    /**
     * Gets the index/key of a given element. The comparison of two elements is strict,
     * that means not only the value but also the type must match.
     * For objects this means reference equality.
     *
     * @param mixed $element The element to search for.
     *
     * @return int|string|bool The key/index of the element or FALSE if the element was not found.
     */
    function indexOf($element);

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
    function slice($offset, $length = null);
}
