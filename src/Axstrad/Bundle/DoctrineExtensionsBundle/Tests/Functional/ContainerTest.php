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

namespace Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional;

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;

/**
 * Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Bundle\ContainerTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensionsBundle
 * @subpackage Tests
 */
class ContainerTest extends WebTestCase
{
    protected $container;

    public function setUp()
    {
        parent::setUp();

        $this->container = self::$kernel->getContainer();
    }

    public function testActivatableListenerClassParameterIsDefined()
    {
        $this->assertTrue(
            $this->container->hasParameter('axstrad_doctrine_extensions.listener.activatable.class')
        );
    }
}
