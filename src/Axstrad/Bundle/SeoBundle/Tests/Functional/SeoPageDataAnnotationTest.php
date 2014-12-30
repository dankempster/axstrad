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

namespace Axstrad\Bundle\SeoBundle\Tests\Functional;

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;

new \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter(array());

/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/SeoBundle
 * @subpackage Tests
 */
class SeoPageDataAnnotationTest extends WebTestCase
{
    /**
     * Load fixtures of these bundles
     *
     * @return array Bundles name where fixtures should be found
     */
    protected function loadBundlesFixtures()
    {
        return array(
            'AxstradTestSeoBundle'
        );
    }

    public function dataProvider()
    {
        $seoAwareExpectations = array(
            'title' => 'Testing Title',
            'keywords' => 'testing, meta, keywords',
            'description' => 'Testing meta description.',
        );

        $seoMetadataExpectations = array(
            'title' => 'Testing Title',
        );

        return array(
            // Seo Aware object tests
            array( '/seo-aware/1', $seoAwareExpectations ),
            array( '/seo-aware/scalar/1/page/1', $seoAwareExpectations ),
            array( '/seo-aware/article/1/page/1', $seoAwareExpectations ),
            array( '/seo-aware/page/1/article/1', $seoAwareExpectations ),

            // Seo Metadata object tests
            array( '/seo-metadata/1', $seoMetadataExpectations ),
            array( '/seo-metadata/scalar/1/data/1', $seoMetadataExpectations ),
            array( '/seo-metadata/article/1/data/1', $seoMetadataExpectations ),
            array( '/seo-metadata/data/1/article/1', $seoMetadataExpectations ),
        );
    }

    /**
     * @dataProvider dataProvider
     */
    public function testAnnotationConfigurationVariations($url, $expectations)
    {
        $client = self::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertEquals(
            $expectations['title'].' | AxstradTestSeoBundle',
            $crawler->filter('title')->text()
        );

        if (isset($expectations['keywords'])) {
            $this->assertEquals(
                $expectations['keywords'],
                $crawler->filter('meta[name="keywords"]')->attr('content')
            );
        }

        if (isset($expectations['description'])) {
            $this->assertEquals(
                $expectations['description'],
                $crawler->filter('meta[name="description"]')->attr('content')
            );
        }
    }
}
