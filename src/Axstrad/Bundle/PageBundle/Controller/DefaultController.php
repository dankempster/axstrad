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

namespace Axstrad\Bundle\PageBundle\Controller;

use Axstrad\Bundle\PageBundle\Entity\Page;
use Axstrad\Bundle\SeoBundle\Configuration\SeoPageData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Axstrad\Bundle\PageBundle\Controller\DefaultController
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 */
class DefaultController extends Controller
{
    /**
     * @ParamConverter("page")
     * @SeoPageData
     */
    public function indexAction(Page $page)
    {
        return new Response(
            $this->renderView(
                'AxstradPageBundle:Default:index.html.twig',
                array(
                    'page' => $page,
                )
            )
        );
    }
}
