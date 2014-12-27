<?php
namespace Axstrad\Component\FileManagement;

use Axstrad\Component\Filesystem\FilesystemAwareTrait;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Axstrad\Component\FileManagement\FileContainer
 */
class FileContainer implements
    Directory,
    FileBag
{
    use FilesystemAwareTrait;
    use FactoryAwareTrait;

    protected $eventDispatcher;
    protected $files;


    public function __construct($path, EventDispatcher $eventDispatcher, array $files = array())
    {
        $this->path = $path;
        $this->files = new ArrayCollection($files);
    }

    /**
     */
    public function getFiles()
    {
        return $this->files->toArray();
    }

    public function addFile(File $file)
    {
        if (!$this->files->contains($file)) {
            $event = $this->getFactory()->createFileEvent($file);

            $this->eventDispatcher->disaptch(Events::FILE_ADD, $event);
        }
        return $this;
    }
}
