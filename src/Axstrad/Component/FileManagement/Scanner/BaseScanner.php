<?php
namespace Axstrad\Component\FileManagement\Scanner;

use Axstrad\Component\FileManagement\Scanner;
use Axstrad\Component\FileManagement\Directory;
use Axstrad\Symonfy\Finder\LazyLoadFinderTrait;
use Axstrad\Component\Processor\GetSetProcessorTrait;


/**
 * Axstrad\Component\FileManagement\Scanner\BaseScanner
 *
 * Scans a directory for files. Each found file is passed to a processor to
 * handle.
 */
class BaseScanner implements
    Scanner
{
    use LazyLoadFinderTrait;
    use ProcessDependantTrait;

    /**
     * @param  Directory $directory
     * @return self
     */
    public function scan(Directory $directory)
    {
        $finder = $this
            ->getFinder()
            ->files()
            ->in($directory->getPath())
        ;
        $processor = $this->getProcessor();
        foreach ($finder as $file) {
            $processor->process($file);
        }

        return $this;
    }
}
