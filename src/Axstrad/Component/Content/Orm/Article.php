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

namespace Axstrad\Component\Content\Orm;

use Axstrad\Component\Content\Traits\Article as ArticleTrait;
use Axstrad\Component\DoctrineOrm\Entity\BaseEntity;

/**
 * Axstrad\Component\Content\Orm\Article
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 * @subpackage ORM
 */
abstract class Article extends BaseEntity
{
    use ArticleTrait;
}
