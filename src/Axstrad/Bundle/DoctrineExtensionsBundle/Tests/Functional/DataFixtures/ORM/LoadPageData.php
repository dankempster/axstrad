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

namespace Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Entity;

/**
 * Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\DataFixtures\ORM\LoadPageData
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensionsBundle
 * @subpackage Tests
 */
class LoadPageData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activeSelfConfiguredPage = new Entity\SelfConfiguredPage;
        $activeSelfConfiguredPage->title = 'Self Configured Page : Active';
        $activeSelfConfiguredPage->active = true;
        $manager->persist($activeSelfConfiguredPage);

        $inactiveSelfConfiguredPage = new Entity\SelfConfiguredPage;
        $inactiveSelfConfiguredPage->title = 'Self Configured Page : Inactive';
        $inactiveSelfConfiguredPage->active = false;
        $manager->persist($inactiveSelfConfiguredPage);

        $activeExtendsEntityPage = new Entity\ExtendsEntityPage;
        $activeExtendsEntityPage->title = 'Extends Entity Page : Active';
        $activeExtendsEntityPage->setActive(true);
        $manager->persist($activeExtendsEntityPage);

        $activeExtendsEntityPage = new Entity\ExtendsEntityPage;
        $activeExtendsEntityPage->title = 'Extends Entity Page : Inactive';
        $activeExtendsEntityPage->setActive(false);
        $manager->persist($activeExtendsEntityPage);

        $activeUsesTraitPage = new Entity\UsesTraitPage;
        $activeUsesTraitPage->title = 'Uses Trait Page : Active';
        $activeUsesTraitPage->setActive(true);
        $manager->persist($activeUsesTraitPage);

        $activeUsesTraitPage = new Entity\UsesTraitPage;
        $activeUsesTraitPage->title = 'Uses Trait Page : Inactive';
        $activeUsesTraitPage->setActive(false);
        $manager->persist($activeUsesTraitPage);

        $manager->flush();
    }
}
