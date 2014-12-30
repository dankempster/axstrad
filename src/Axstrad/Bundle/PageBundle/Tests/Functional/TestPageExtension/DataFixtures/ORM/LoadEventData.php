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

namespace Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension\DataFixtures\ORM;

use Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension\Entity\Event;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Cmf\Bundle\SeoBundle\Model\SeoMetadata;


/**
 * Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension\DataFixtures\ORM\LoadEventData
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage Tests
 */
class LoadEventData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $event = new Event();
        $event->setHeading('An Event');
        $event->setCopy('<p>Our first event.</p>');
        $event->setSlug('an-event');
        $manager->persist($event);

        $eventSeo = new SeoMetadata();
        $eventSeo->setMetaDescription('Meta description for an event.');
        $eventSeo->setMetaKeywords('an, event');
        $eventSeo->setTitle('An Event');
        $manager->persist($eventSeo);

        $event->setSeoMetadata($eventSeo);

        $manager->flush();
    }
}
