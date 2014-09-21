<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @package Axstrad\Common
 * @subpackage Traits
 */
namespace Axstrad\Common\Traits;

use PhpOption\Option as PhpOption;


/**
 * Axstrad\Common\Traits\TimestampableTrait
 */
trait TimestampableTrait
{
    use TimestampTrait {
        TimestampTrait::getTimestamp as private _getTimestamp;
        TimestampTrait::setTimestamp as private _setTimestamp;
    }


    /**
     * Get datetime
     *
     * @param  null|string $format Specify a format to return the timestamp in
     * @return string|PhpOption String if $format is not NULL, PhpOption object
     *         otherwise
     */
    public function getTimestamp($format = null)
    {
        if ($format !== null && $this->timestamp !== null) {
            return $this->_getTimestamp($format);
        }

        return PhpOption::fromValue(
            $this->timestamp !== null ? $this->_getTimestamp($format) : null
        );
    }

    /**
     * Set datetime
     *
     * @param null|string|DateTime $timestamp
     * @return self
     * @throws InvalidArgumentException If $timestamp is not a DateTime object.
     */
    public function setTimestamp($timestamp = null)
    {
        if ($timestamp === null) {
            $this->timestamp = null;
            return $this;
        }

        return $this->_setTimestamp($timestamp);
    }
}
