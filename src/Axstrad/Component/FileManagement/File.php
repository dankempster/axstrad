<?php
namespace Axstrad\Component\FileManagement;


/**
 * Axstrad\Component\FileManagement\File
 *
 * Implement this interface for your class to be treated as a File
 */
interface File
{
    /**
     * Get the file's info
     *
     * @return SplFileInfo
     */
    public function getInfo();
}
