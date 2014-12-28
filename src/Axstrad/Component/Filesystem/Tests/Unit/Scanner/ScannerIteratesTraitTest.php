<?php
namespace Axstrad\Component\Filesystem\Tests\Unit\Scanner;

use Axstrad\Component\Test\TraitTestCase;
use Axstrad\Component\Filesystem\Scanner\ScannerIteratesTrait;

/**
 * Axstrad\Component\Filesystem\Tests\Unit\Scanner\ScannerIteratesTraitTest
 *
 * @group unit
 */
class ScannerIteratesTraitTest extends TraitTestCase
{
    use ScannerIteratesTrait;


    public function setUp()
    {
        $this->fixture = $this->getMockForTrait('Axstrad\Component\Filesystem\Scanner\ScannerIteratesTrait');
    }

    /**
     * @covers Axstrad\Component\Filesystem\Scanner\ScannerIteratesTrait::setIterator
     */
    public function testSetIteratorAcceptsDirectoryIterator()
    {
        $this->fixture->setIterator(new \DirectoryIterator(sys_get_temp_dir()));
    }

    /**
     * @covers Axstrad\Component\Filesystem\Scanner\ScannerIteratesTrait::setIterator
     * @depends testSetIteratorAcceptsDirectoryIterator
     */
    public function testSetIteratorAcceptsOuterIterator()
    {
        $this->fixture->setIterator($this->getMockForAbstractClass('OuterIterator'));
    }

    /**
     * @covers Axstrad\Component\Filesystem\Scanner\ScannerIteratesTrait::setIterator
     * @depends testSetIteratorAcceptsOuterIterator
     * @expectedException Axstrad\Component\Filesystem\Exception\InvalidArgumentException
     */
    public function testSetIteratorThrowsException1()
    {
        $this->fixture->setIterator($this->getMockForAbstractClass('Iterator'));
    }

    /**
     * @covers Axstrad\Component\Filesystem\Scanner\ScannerIteratesTrait::throwExceptionIfNoIterator
     * @expectedException Axstrad\Component\Filesystem\Exception\MissingIteratorException
     */
    public function testthrowExceptionIfNoIterator()
    {
        $this->throwExceptionIfNoIterator();
    }
}
