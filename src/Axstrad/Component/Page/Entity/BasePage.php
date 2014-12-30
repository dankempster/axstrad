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

namespace Axstrad\Component\Page\Entity;

use Axstrad\Component\Content\Orm\Article as BaseArticle;
use Axstrad\Component\Page\Page;
use Axstrad\DoctrineExtensions\Sluggable\SluggableTrait;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareTrait;


/**
 * Axstrad\Component\Page\Entity\BasePage
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Page
 */
abstract class BasePage extends BaseArticle implements
    Page
{
    use SeoAwareTrait;
    use SluggableTrait;
}
