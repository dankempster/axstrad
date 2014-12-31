<?php
namespace Axstrad\Bridge\FilesystemWorker;

use Axstrad\Component\Filesystem\ScannerIterates;
use Axstrad\Component\Filesystem\Traits\ScannerIteratesTrait;
use Axstrad\Component\WorkForce\WorkerDependantTrait;


/**
 * Axstrad\Bridge\FilesystemWorker\Scanner
 *
 * A scanner that uses an Axstrad\Component\WorkForce\Worker for working each
 * file and returns the number of successfully "worked" files.
 */
class Scanner implements
    ScannerIterates
{
    use ScannerIteratesTrait;
    use WorkerDependantTrait;


    /**
     * @return integer[] Counts of the found files (fileCount) and successfully
     *         "worked" files (successCount).
     * @uses getIterator To get the file iterator
     * @uses getWorker To get the worker to work each file.
     */
    public function scan()
    {
        $reuslt = array();
        $result['fileCount'] = 0;
        $result['successCount'] = 0;

        $worker = $this->getWorker();
        foreach ($this->getIterator() as $file) {
            $result['fileCount']++;
            if ($worker->work($file)->isSuccessful()) {
                $result['successCount']++;
            }
        }

        return $result;
    }
}
