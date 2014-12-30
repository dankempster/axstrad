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

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;

/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage Tests
 */
class SeoDataTest extends WebTestCase
{
    protected $crawler;

    protected $response;

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

        $this->client = self::createClient();
        $this->crawler = $this->client->request('GET', '/about-us');
        $this->response = $this->client->getResponse();
    }

    public function testPageHasTitle()
    {
        $this->assertEquals(
            'About Us | AxstradTestPageBundle',
            $this->crawler->filter('title')->text()
        );
    }

    public function testPageHasMetaKeywords()
    {
        $this->assertEquals(
            'about, us',
            $this->crawler->filter('meta[name="keywords"]')->attr('content')
        );
    }

    public function testPageHasMetaDescription()
    {
        $this->assertEquals(
            'Meta description about us.',
            $this->crawler->filter('meta[name="description"]')->attr('content')
        );
    }
}
