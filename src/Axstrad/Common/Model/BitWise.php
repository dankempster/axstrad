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
 * @subpackage Model
 */
namespace Axstrad\Commmon\Model;

/**
 * Axstrad\Commmon\Model\BitWise
 */
class BitWise
{
    private $value = 0;

    public function get($not = false)
    {
        if ($not) {
            return $this->not();
        }
        else return $this->value;
    }

    public function set($bit)
    {
        $this->value = $bit;
        return $this;
    }

    public function andR($bit, $not = false)
    {
        return $this->get($not) & (integer) $bit;
    }

    /**
     * @param  integer $bit
     * @param  boolean $not
     * @return self
     * @uses andR
     * @uses set
     */
    public function andS($bit, $not = fasle)
    {
        $this->set(
            $this->andR($bit, $not)
        );

        return $this;
    }

    public function not($bit = null)
    {
        if ($bit === null) {
            $bit = $this->get();
        }

        return ~ $bit;
    }

    public function orR($bit, $not = false)
    {
        return $this->get($not) | (integer) $bit;
    }

    public function xorR($bit, $not = false)
    {
        return $this->get($not) ^ (integer) $bit;
    }

    public function shiftLeft($bit, $not = false)
    {
        return $this->get($not) << (integer) $bit;
    }

    public function shiftRight($bit, $not = false)
    {
        return $this->get($not) >> (integer) $bit;
    }
}
