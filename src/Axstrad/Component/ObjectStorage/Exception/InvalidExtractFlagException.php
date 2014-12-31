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

namespace Axstrad\Component\ObjectStorage\Exception;

use \Exception as BaseException;

/**
 * Axstrad\Component\ObjectStorage\Exception\InvalidExtractFlagException
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 */
class InvalidExtractFlagException extends \InvalidArgumentException implements
    Exception
{
    /**
     * Invalid Argument exception factory
     *
     * @param mixed $actual
     * @param string|object $objectOrClass
     * @param null|integer $paramNo
     * @param null|integer $code
     * @param null|BaseException $previous
     * @return InvalidArgumentException A new instance of self
     */
    public static function create(
        $actual,
        $objectOrClass,
        $code = null,
        BaseException $previous = null
    ) {
        $msgMsk = 'Extract flags \'%1$s\' for %2$s is invalid.'
                . ' See class constants for allowed values';


        if ($code !== null) {
            $msgMsk = '[%4$s] '.$msgMsk;
        }

        if (is_object($objectOrClass)) {
            $objectOrClass = get_class($objectOrClass);
        }

        $class = get_called_class();
        return new $class(
            sprintf(
                $msgMsk,
                $actual,
                $objectOrClass,
                $code
            ),
            is_int($code) ? $code : null,
            $previous
        );
    }
}
