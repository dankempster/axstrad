<?php
namespace Axstrad\Component\FileManagement;


/**
 * Axstrad\Component\FileManagement\BasicFile
 *
 * Implement this interface for your class to be treated as a File
 */
class BasicFile implements
    File
{
    protected $info;

    /**
     * Get info
     *
     * @return SplFileInfo
     * @see setInfo
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set info
     *
     * @param SplFileInfo $info
     * @return self
     * @see getInfo
     */
    public function setInfo(\SplFileInf $info)
    {
        $this->info = $info;

        return $this;
    }
}
