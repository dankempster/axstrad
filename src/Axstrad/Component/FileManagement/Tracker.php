<?php
namespace Axstrad\Component\FileManagement;


class FileTracker implements
    Directory,
    FileBag
{
    use FileBagTrait;
    use DirectoryTrait;
}
