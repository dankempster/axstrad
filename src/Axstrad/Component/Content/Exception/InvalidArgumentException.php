<?php
namespace Axstrad\Component\Content\Exception;

use Axstrad\Common\Exception\InvalidArgumentException as BaseException;


/**
 * Axstrad\Component\Content\Exception\InvalidArgumentException
 */
class InvalidArgumentException extends BaseException implements
    Exception
{
    public static function create()
    {
        return new self;
    }
}
