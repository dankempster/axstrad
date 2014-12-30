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

namespace Axstrad\Component\Iterator\Tests;

use Axstrad\Component\Iterator\SplObjectStorageIterator;
use Axstrad\Component\Test\TestCase;
use SplObjectStorage;
use StdClass;


/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 */
class SplObjectStorageSeekableIteratorTest extends TestCase
{
    /**
     * @dataProvider seekDataProvider
     */
    public function testCanSeek($objects, $index, $expectedObject)
    {
        // Fixture set up
        $storage = new SplObjectStorage();
        foreach ($objects as $key => $object) {
            $storage->attach($object, $key);
        }
        $iterator = new SplObjectStorageIterator($storage);
        $iterator->setValueFlags(SplObjectStorageIterator::VALUE_OBJECT);

        // Test
        $iterator->seek($index);
        $this->assertSame(
            $expectedObject,
            $iterator->current()
        );
        $this->assertEquals(
            $index,
            $iterator->getInfo()
        );
    }

    public function seekDataProvider()
    {
        $objects = array(
            new StdClass,
            new StdClass,
            new StdClass,
            new StdClass,
            new StdClass,
        );

        return array(
            array(
                $objects,
                0,
                $objects[0]
            ),
            array(
                $objects,
                2,
                $objects[2]
            ),
            array(
                $objects,
                4,
                $objects[4]
            ),
        );
    }
}
