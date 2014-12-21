<?php
namespace Axstrad\Component\Iterator\Tests;

use Axstrad\Component\Iterator\SplObjectStorageIterator;
use Axstrad\Component\Test\TestCase;
use SplObjectStorage;
use StdClass;


/**
 */
class SplObjectIteratorTest extends TestCase
{
    public function setUp()
    {
        $storage = new SplObjectStorage();
        $this->testObject = new StdClass;
        $this->testInfo = 'foo';
        $storage->attach($this->testObject, $this->testInfo);

        $this->fixture = new SplObjectStorageIterator($storage);
    }

    public function testDefaultValueIsObject()
    {
        foreach ($this->fixture as $value) {
            $this->assertEquals(
                $this->testObject,
                $value
            );
        }
    }

    public function testKeyReturnsNumeric()
    {
        foreach ($this->fixture as $key => $value) {
            $this->assertEquals(
                0,
                $key
            );
        }
    }

    public function testCanSetValueToInfo()
    {
        $this->fixture->setValueFlags(SplObjectStorageIterator::VALUE_INFO);
        foreach ($this->fixture as $value) {
            $this->assertEquals(
                $this->testInfo,
                $value
            );
        }
    }

    public function testCanSetValueToBoth()
    {
        $this->fixture->setValueFlags(SplObjectStorageIterator::VALUE_BOTH);
        foreach ($this->fixture as $value) {
            $this->assertEquals(
                array(
                    'object' => $this->testObject,
                    'info' => $this->testInfo,
                ),
                $value
            );
        }
    }

    public function testCanGetInfo()
    {
        foreach ($this->fixture as $value) {
            $this->assertEquals(
                $this->testInfo,
                $this->fixture->getInfo()
            );
        }
    }

    /**
     * @expectedException Axstrad\Component\Iterator\Exception\InvalidArgumentException
     */
    public function testSetValueKeysThrowsException()
    {
        $this->fixture->setValueFlags('foo');
    }
}
