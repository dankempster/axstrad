<?php
namespace Axstrad\Component\Iterator\Tests;

use Axstrad\Component\Iterator\SplObjectStorageIterator;
use Axstrad\Component\Test\TestCase;
use SplObjectStorage;
use StdClass;


/**
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
