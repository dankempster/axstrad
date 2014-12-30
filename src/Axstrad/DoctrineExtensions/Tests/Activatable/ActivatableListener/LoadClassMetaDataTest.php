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

namespace Axstrad\DoctrineExtensions\Tests\Activatable\ActivatableListener;

use Axstrad\DoctrineExtensions\Activatable\ActivatableListener;

/**
 * Axstrad\DoctrineExtensions\Tests\Activatable\ActivatableListener\LoadClassMetaDataTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensions
 * @subpackage Tests
 * @uses Axstrad\DoctrineExtensions\Activatable\ActivatableListener
 */
class LoadClassMetaDataTest extends \PHPUnit_Framework_TestCase
{
    protected $fixture = null;

    public function setUp()
    {
        $this->fixture = new ActivatableListener;
    }

    /**
     * covers Axstrad\DoctrineExtensions\Activatable\ActivatableListener::getSubscribedEvents
     */
    public function testSubscribesToLoadClassMetaDataEvent()
    {
        $this->assertEquals(
            array(
                'loadClassMetadata',
            ),
            $this->fixture->getSubscribedEvents()
        );
    }

    /**
     * covers Axstrad\DoctrineExtensions\Activatable\ActivatableListener::getNamespace
     */
    public function testGetNamespace()
    {
        $this->assertEquals(
            'Axstrad\DoctrineExtensions\Activatable',
            $this->fixture->getNamespace()
        );
    }
}
