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
 * Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Bundle\ActivatableOrmFilterTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensionsBundle
 * @subpackage Tests
 */
class ActivatableOrmFilterTest extends WebTestCase
{
    protected $em;

    public function setUp()
    {
        parent::setUp();

        $container = self::$kernel->getContainer();
        $this->em = $container->get('doctrine.orm.entity_manager');
    }

    /**
     * Load fixtures of these bundles
     *
     * @return array Bundles name where fixtures should be found
     */
    protected function loadBundlesFixtures()
    {
        return array(
            'AxstradTestDoctrineExtensionsBundle'
        );
    }

    /**
     */
    public function testFilterIsEnabled()
    {
        $this->em->getFilters()->enable('activatable');
        $this->assertInstanceOf(
            'Axstrad\DoctrineExtensions\Activatable\Filter\OrmFilter',
            $this->em->getFilters()->getFilter('activatable')
        );
    }

    public function activatableEntitiesData()
    {
        return array(
            array(
                'AxstradTestDoctrineExtensionsBundle:SelfConfiguredPage',
                1
            ),
            array(
                'AxstradTestDoctrineExtensionsBundle:ExtendsEntityPage',
                1
            ),
            array(
                'AxstradTestDoctrineExtensionsBundle:UsesTraitPage',
                1
            ),
        );
    }

    /**
     * @dataProvider activatableEntitiesData
     * @depends testFilterIsEnabled
     */
    public function testFilterIsActive($entity, $expectedCount)
    {
        $repo = $this->em->getRepository($entity);
        $entities = $repo->findAll();
        $this->assertEquals(
            $expectedCount,
            count($entities)
        );
    }

    /**
     * @depends testFilterIsActive
     */
    public function testFilterCanBeDisabledPerEntity()
    {
        $this->em
            ->getFilters()
            ->getFilter('activatable')
            ->disableForEntity('Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Entity\SelfConfiguredPage')
        ;

        $this->testFilterIsActive('Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Entity\SelfConfiguredPage', 2);
    }
}
