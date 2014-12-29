<?php
namespace Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension;

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;


class PageExtensionTest extends WebTestCase
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
            'AxstradTestPageExtensionBundle',
        );
    }

    public function setUp()
    {
        parent::setUp();

        $this->client = self::createClient();
        $this->crawler = $this->client->request('GET', '/events/an-event');
        $this->response = $this->client->getResponse();
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
            'An Event',
            $this->crawler->filter('h1')->text()
        );
    }

    public function testPageHasCopy()
    {
        $this->assertEquals(
            'Our first event.',
            $this->crawler->filter('p')->text()
        );
    }

    public function testPageHasTitle()
    {
        $this->assertEquals(
            'An Event | AxstradTestPageExtensionBundle',
            $this->crawler->filter('title')->text()
        );
    }

    public function testPageHasMetaKeywords()
    {
        $this->assertEquals(
            'an, event',
            $this->crawler->filter('meta[name="keywords"]')->attr('content')
        );
    }

    public function testPageHasMetaDescription()
    {
        $this->assertEquals(
            'Meta description for an event.',
            $this->crawler->filter('meta[name="description"]')->attr('content')
        );
    }
}