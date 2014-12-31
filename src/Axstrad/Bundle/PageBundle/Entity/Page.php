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

namespace Axstrad\Bundle\PageBundle\Entity;

use Axstrad\DoctrineExtensions\Activatable\ActivatableTrait;
use Axstrad\Component\Content\Orm\Article;
use Axstrad\DoctrineExtensions\Sluggable\SluggableTrait;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareTrait;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface;

/**
 * Axstrad\Bundle\PageBundle\Entity\Page
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/PageBundle
 * @subpackage ORM
 */
class Page extends Article implements
    SeoAwareInterface
{
    use ActivatableTrait;
    use SeoAwareTrait;
    use SluggableTrait;
}

