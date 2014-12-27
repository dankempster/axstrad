<?php
namespace Axstrad\Component\FileManagement;


/**
 * Axstrad\Component\FileManagement\Directory
 */
interface Directory
{
    /**
     * Returns the path to the Directory.
     *
     * @return string Any path or URL accept by fopen()
     */
    public function getPath();
}
