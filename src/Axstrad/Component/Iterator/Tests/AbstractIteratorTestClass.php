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
 * @package Axstrad\Component\Iterator
 */
namespace Axstrad\Component\Iterator\Tests;

use Axstrad\Component\Iterator\AbstractIterator;


/**
 * Axstrad\Component\Iterator\Test\AbstractIteratorTestClass
 */
class AbstractIteratorTestClass extends AbstractIterator
{
	protected $values = array( );

	public function setTestsValueToIterate(array $values)
	{
		$this->values = $values;
	}

	public function next()
	{
		$this->currentKey ++;
		$this->currentValue = isset($this->values[$this->currentKey]) ? $this->values[$this->currentKey] : null;
	}

	public function getLength()
	{
		return parent::getLength();
	}
}
