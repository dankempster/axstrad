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
namespace Axstrad\Component\Iterator\Tests;

use Axstrad\Component\Iterator\CsvIterator;


/**
 * Axstrad\Component\Iterator\Test\CsvIteratorTest
 *
 * @group unittest
 * @uses Axstrad\Common\Traits\OptionsResolverTrait
 * @uses Axstrad\Component\Iterator\AbstractIterator
 * @uses Axstrad\Component\Iterator\CsvIterator
 */
class CsvIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Axstrad\Component\Iterator\CsvIterator
     */
    protected $fixture;

    /**
     * @var string
     */
    protected $testFilePath;


    /**
     */
    public function setUp()
    {
        $this->testFilePath = __DIR__.'/_files/testcsv.csv';

        $this->fixture = new CsvIterator($this->testFilePath);
    }

    /**
     * @covers Axstrad\Component\Iterator\CsvIterator::valid
     */
    public function testIsNotValidBeforeIterationStart()
    {
        $this->assertFalse($this->fixture->valid());
    }

    /**
     * @covers Axstrad\Component\Iterator\CsvIterator::__construct
     */
    public function testThrowsExceptionIfFileDontExist()
    {
        $this->setExpectedException('Axstrad\Component\Iterator\Exception\InvalidArgumentException');

        new CsvIterator('none/existant/file');
    }
}
