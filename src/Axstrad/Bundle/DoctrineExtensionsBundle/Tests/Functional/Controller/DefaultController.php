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

namespace Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Controller;

use Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Entity\SelfConfiguredPage;
use Axstrad\Bundle\DoctrineExtensionsBundle\Tests\Functional\Entity\ExtendsEntityPage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

new ParamConverter(array());

/**
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/DoctrineExtensionsBundle
 * @subpackage Tests
 */
class DefaultController extends Controller
{
    /**
     * @ParamConverter("page")
     * @param  SelfConfiguredPage $page
     * @return Response
     */
    public function loadSelfConfiguredPageAction(SelfConfiguredPage $page)
    {
        return new Response($page->title);
    }
    /**
     * @ParamConverter("page")
     * @param  ExtendsEntityPage $page
     * @return Response
     */
    public function loadExtendsEntityPageAction(ExtendsEntityPage $page)
    {
        return new Response($page->title);
    }
}
