<?php
namespace Axstrad\Component\FileManagement\Tests\Scanner;

use Axstrad\Component\FileManagement\Scanner\BaseScanner;
use Axstrad\Component\Test\TestCase;


/**
 * Axstrad\Component\FileManagement\Tests\Scanner\BaseScannerTest
 */
class BaseScannerTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new BaseScanner;
    }

    // public function testAddsFoundFilesToBag()
    // {
    //     $mockFinder = $this->getMockBuilder('Symfony\Component\Finder\Finder');
    //     $mockFinder
    //         ->expect($this->once())
    //         ->method('files')
    //         ->will($this->self())
    //     ;
    //     $mockFinder
    //         ->expect($this->once())
    //         ->method('in')
    //         ->with('/some/path')
    //     ;

    //     $this->fixture->setFinder($mockFinder);
    //     $this->fixture->scan($mockDirectory);
    // }
}
