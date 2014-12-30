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

namespace Axstrad\Component\Content\Exception;

use Axstrad\Common\Exception\InvalidArgumentException as BaseException;

/**
 * Axstrad\Component\Content\Exception\InvalidArgumentException
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/Content
 * @subpackage Exceptions
 */
class InvalidArgumentException extends BaseException implements
    Exception
{
    public static function create()
    {
        return new self;
    }
}
