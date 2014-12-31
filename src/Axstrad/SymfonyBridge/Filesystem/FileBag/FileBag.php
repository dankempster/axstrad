<?php
namespace Axstrad\Component\Filesystem\FileBag;

use Axstrad\Component\Filesystem\Traits;
use Axstrad\Component\Filesystem\FileBag as FileBagInterface;
use Symfony\Component\Finder\SplFileInfo as File;


/**
 * Axstrad\SymfonyBridge\Filesystem\FileBag\FileBag
 *
 * This is the same as {@see Axstrad\Component\Filesystem\FileBag\FileBag
 * Axstrad\Filesystem's filebag} excpet that it requires {@link
 * http://api.symfony.com/2.3/Symfony/Component/Finder/SplFileInfo.html
 * Symfony's SplFileInfo}.
 */
class FileBag implements
    FileBagInterface
{
    use Traits\FileBagTrait;
}


