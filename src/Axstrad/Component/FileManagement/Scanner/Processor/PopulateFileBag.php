<?php
namespace Axstrad\Component\FileManagement\Scanner\Processor;

use Axstrad\Component\FileManagement\File;
use Axstrad\Component\FileManagement\BasicFile;
use Axstrad\Component\FileManagement\FileBag;
use Axstrad\Component\Processor\Processor;


/**
 * Axstrad\Component\FileManagement\Scanner\Processor\PopulateFileBag
 *
 * Hands the SplFileInfo object onto a FileBag for storage.
 */
class BaseScanner implements
    Processor
{
    protected $fileBag;


    public function __construct(FileBag $fileBag = null)
    {
        $this->fileBag = $fileBag;
    }

    /**
     * Get fileBag
     *
     * @return FileBag
     * @see setFileBag
     */
    public function getFileBag()
    {
        return $this->fileBag;
    }

    /**
     * Set fileBag
     *
     * @param  FileBag $fileBag
     * @return self
     * @see getFileBag
     */
    public function setFileBag(FileBag $fileBag)
    {
        $this->fileBag = $fileBag;

        return $this;
    }

    public function supports($data)
    {
        return $data instanceof \SplFileInfo
            || $data instanceof File
        ;
    }

    public function process($data)
    {
        if ($data instanceof \SplFileInfo) {
            $data = new BasicFile();
            $data->setSplFileInfo($data);
        }
        $this->fileBag->add($data);
        return true;
    }
}
