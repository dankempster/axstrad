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

namespace Axstrad\Bundle\SeoBundle\Tests\Functional\DataFixtures\ORM;

use Axstrad\Bundle\SeoBundle\Tests\Functional\Entity\Article;
use Axstrad\Bundle\SeoBundle\Tests\Functional\Entity\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Cmf\Bundle\SeoBundle\Model\SeoMetadata;


/**
 * Axstrad\Bundle\SeoBundle\Tests\Functional\DataFixtures\ORM\LoadData
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/SeoBundle
 * @subpackage Tests
 */
class LoadData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $page = new Page();
        $page->setHeading('Testing');
        $manager->persist($page);

        $pageSeo = new SeoMetadata();
        $pageSeo->setMetaDescription('Testing meta description.');
        $pageSeo->setMetaKeywords('testing, meta, keywords');
        $pageSeo->setTitle('Testing Title');
        $manager->persist($pageSeo);

        $page->setSeoMetadata($pageSeo);

        $article = new Article();
        $article->setHeading('Article');
        $manager->persist($article);

        $manager->flush();
    }
}
