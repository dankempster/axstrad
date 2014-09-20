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
namespace Axstrad\Component\Iterator;

use Axstrad\Common\Traits\OptionsResolverTrait;
use Axstrad\Component\Iterator\Exception\InvalidArgumentException;
use Axstrad\Component\Iterator\Exception\LogicException;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Axstrad\Component\Iterator\CsvIterator
 */
class CsvIterator extends AbstractIterator
{
    use OptionsResolverTrait;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var resource
     */
    private $fileHandle = null;


    /**
     * Class constructor
     *
     * @param string $filePath Path to the CSV file
     * @param null|array|\Traversable $options Options for reading the CSV file.
     *        Allowed options are:
     *            - length
     *            - delimiter
     *            - enclosure
     *            - escape
     * @throws Axstrad\Component\Iterator\Exception\InvalidArgumentException If $filePath
     *         doesn't exist.
     */
    public function __construct($filePath, array $options = array())
    {
        if (!file_exists($filePath)) {
            throw new InvalidArgumentException($filePath." doesn't eixst");
        }

        $this->filePath = $filePath;

        $this->resolveOptions($options);
        parent::__construct();
    }

    /**
     * Closes the file handle
     */
    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    /**
     */
    protected function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'delimitor' => ',',
            'enclosure' => '"',
            'escpae' => '\\',
            'length' => 0,
        ));
    }

    /**
     * Returns the path to the CSV.
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }


    /**
     */
    public function next()
    {
        $this->currentKey++;
        $this->currentValue = fgetcsv(
            $this->fileHandle,
            $this->options['length'],
            $this->options['delimitor'],
            $this->options['enclosure'],
            $this->options['escape']
        );
    }

    /**
     * @uses getFilePath
     */
    public function rewind()
    {
        if (!empty($this->fileHandle)) {
            fclose($this->fileHandle);
        }
        $this->fileHandle = fopen($this->getFilePath(), 'r');

        parent::rewind();
    }

    /**
     */
    public function valid()
    {
        return is_array($this->currentValue);
    }
}
