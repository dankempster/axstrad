<?php

namespace Axstrad\Bundle\PageBundle\Controller;

use Axstrad\Bundle\PageBundle\Entity\Page;
use Axstrad\Bundle\SeoBundle\Configuration\SeoPageData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 * Axstrad\Bundle\PageBundle\Controller\DefaultController
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