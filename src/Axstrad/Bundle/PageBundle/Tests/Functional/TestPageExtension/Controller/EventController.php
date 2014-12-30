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

namespace Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension\Controller;

use Axstrad\Bundle\SeoBundle\Configuration\SeoPageData;
use Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension\Entity\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Cmf\Bundle\SeoBundle\Model\SeoMetadata;
use Symfony\Component\HttpFoundation\Response;

/**
 * Axstrad\Bundle\PageBundle\Tests\Functional\TestPageExtension\Controller\EventController
 *
 * A controller to test that AxstradPageBundle:Page entity can be extended and
 * resused with esae.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage Tests
 */
class EventController extends Controller
{
    /**
     * @ParamConverter("event")
     * @SeoPageData()
     */
    public function indexAction(Event $event)
    {
        return new Response(
            $this->renderView(
                'AxstradPageBundle:Default:index.html.twig',
                array(
                    'page' => $event,
                )
            )
        );
    }
}
