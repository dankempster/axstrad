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

namespace Axstrad\Bundle\PageBundle\Tests\Functional\TestPage\Controller;

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;

/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage Tests
 */
class DefaultControllerTest extends WebTestCase
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

    public function testPageIsSuccessful()
    {
        $this->assertTrue(
            $this->response->isSuccessful(),
            'Request was not successful'
        );
    }

    public function testPageHasHeading()
    {
        $this->assertTrue(
            $this->crawler->filter('h1')->count() > 0
        );
    }

    public function testPageHasCorrectHeadingValue()
    {
        $this->assertEquals(
            'About Us',
            $this->crawler->filter('h1')->text()
        );
    }

    public function testPageHasCopy()
    {
        $this->assertEquals(
            'A page about us.',
            $this->crawler->filter('p')->text()
        );
    }
}
