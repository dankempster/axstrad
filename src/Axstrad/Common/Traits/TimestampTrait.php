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

use DateTime;
use InvalidArgumentException;


/**
 * Axstrad\Common\Traits\TimestampTrait
 */
trait TimestampTrait
{
    /**
     * @var DateTime
     */
    protected $timestamp;


    /**
     * Get datetime
     *
     * @param  null|string $format Specify a format to return the timestamp in
     * @return string|DateTime String if $format is not NULL, DateTime object
     *         otherwise
     */
    public function getTimestamp($format = null)
    {
        if ($format === null) {
            return clone $this->timestamp;
        }

        return $this->timestamp->format($format);
    }

    /**
     * Set datetime
     *
     * @param string|DateTime $timestamp
     * @return self
     * @throws InvalidArgumentException If $timestamp is not a DateTime object.
     */
    public function setTimestamp($timestamp)
    {
        if (is_string($timestamp)) {
            $this->timestamp = new DateTime($timestamp);
        }
        elseif ($timestamp instanceof Datetime) {
            $this->timestamp = clone $timestamp;
        }
        else {
            throw new InvalidArgumentException(
                "\$timestamp must be a DateTime object or a string"
            );
        }
        return $this;
    }
}
