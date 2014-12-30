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

namespace Axstrad\Bundle\PageBundle\Tests\Functional\TestPage;

use Axstrad\Bundle\PageBundle\Entity\Page;
use Axstrad\Bundle\TestBundle\Functional\WebTestCase;

/**
 * Axstrad\Bundle\PageBundle\Tests\Functional\TestPage\PageEntityTest
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage Tests
 */
class PageEntityTest extends WebTestCase
{
    protected $em;

    protected $repo;

    /**
     * Load fixtures of these bundles
     *
     * @return array Bundles name where fixtures should be found
     */
    protected function loadBundlesFixtures()
    {
        return array(
            'AxstradPageTestHelperBundle',
        );
    }

    public function setUp()
    {
        parent::setUp();

        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->repo = $this->em->getRepository('Axstrad\Bundle\PageBundle\Entity\Page');
    }

    public function testPagePersistence()
    {
        $fixture = new Page();
        $fixture->setHeading('heading');
        $fixture->setCopy('copy');

        $this->em->persist($fixture);
        $this->em->flush();
        $this->em->detach($fixture);
        unset($fixture);
        $this->em->clear();
        $fixture = $this->em->find('Axstrad\Bundle\PageBundle\Entity\Page', 2);

        $this->assertEquals(
            'heading',
            $fixture->getHeading()
        );

        $this->assertEquals(
            'copy',
            $fixture->getCopy()
        );
    }
}
