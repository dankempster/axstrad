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

use Axstrad\Component\ObjectStorage\Iterator;
use Axstrad\Component\Test\TestCase;
use SplObjectStorage;
use StdClass;


/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 */
class SplObjectIteratorTest extends TestCase
{
    public function setUp()
    {
        $storage = new SplObjectStorage();
        $this->testObject = new StdClass;
        $this->testInfo = 'foo';
        $storage->attach($this->testObject, $this->testInfo);

        $this->fixture = new Iterator($storage);
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
        $this->fixture->setExtractFlags(Iterator::EXTR_INFO);
        foreach ($this->fixture as $value) {
            $this->assertEquals(
                $this->testInfo,
                $value
            );
        }
    }

    public function testCanSetValueToBoth()
    {
        $this->fixture->setExtractFlags(Iterator::EXTR_BOTH);
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
        $this->fixture->setExtractFlags('foo');
    }
}
