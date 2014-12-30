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

namespace Axstrad\Bundle\SeoBundle\Tests\Functional\Entity;

use Axstrad\Component\Content\Orm\Article as BaseArticle;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareInterface;
use Symfony\Cmf\Bundle\SeoBundle\SeoAwareTrait;

/**
 * Axstrad\Bundle\SeoBundle\Tests\Functonal\Entity\Article
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/SeoBundle
 * @subpackage Tests
 * @ORM\Entity
 */
class Article extends BaseArticle
{

}
