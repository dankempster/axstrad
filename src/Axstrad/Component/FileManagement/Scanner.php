<?php
namespace Axstrad\Component\FileManagement;

use Axstrad\Component\Processor\Processor;


/**
 * Axstrad\Component\FileManagement\Scanner
 *
 * Scans a directory for files. Each found file is passed to a processor to
 * handle.
 */
interface Scanner
{
    /**
     * @param  Directory $directory
     * @return self
     */
    public function scan(Directory $directory);

    /**
     * Set the process to run for each "scanned" file.
     *
     * The processor obect will be passed an SplFileInfo object.
     *
     * @param Processor $processor
     */
    public function setProcessor(Processor $processor);
}
