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
namespace Axstrad\Common\Tests\Traits;

use Axstrad\Common\Traits\TimestampTrait;


/**
 * Axstrad\Common\Tests\Traits\TimestampTestClass
 */
class TimestampTestClass
{
    use TimestampTrait;

    public function __construct(\DateTime $timestamp)
    {
        $this->setTimestamp($timestamp);
    }
}
