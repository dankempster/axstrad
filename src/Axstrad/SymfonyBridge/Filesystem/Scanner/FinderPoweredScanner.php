<?php
namespace Axstrad\SymfonyBridge\Filesystem\Scanner;

use Axstrad\Component\Filesystem\FileBag\FileBag;
use Axstrad\Component\Filesystem\Scanner;
use Axstrad\Symfony\Finder\FinderAwareTrait;
use Axstrad\SymfonyBridge\Filesystem\Exception\FinderNotDefinedException;
use Axstrad\SymfonyBridge\Filesystem\Exception\InvalidArgumentException;
use Axstrad\SymfonyBridge\Filesystem\Exception\UnexpectedValueException;


/**
 * Axstrad\SymfonyBridge\Filesystem\Scanner\FinderPoweredScanner
 *
 * An Axstrad\Filesystem compatable {@see Axstrad\Component\Filesystem\Scanner
 * Scanner} which uses Symfony's Finder component to "scan" the filesystem.
 * Using Symfony's Finder provides much easier control over what files are
 * ignore vs scanned compared to using combinations of iterators.
 */
class FinderPoweredScanner implements
    Scanner
{
    use FinderAwareTrait;


    /**
     * {@inheritDoc}
     *
     * @return FileBag A collection of all the found files during the scan.
     * @uses getFinder To get the current finder instance
     * @throws FinderNotDefinedException If the finder has not yet been set.
     */
    public function scan()
    {
        $finder = $this->getFinder();
        if (empty($finder)) {
            throw new FinderNotDefinedException(
                "You must set the DirectoryIterator before attempting to scan"
            );
        }

        $bag = new FileBag;
        foreach ($finder as $file) {
            $bag[] = $file;
        }

        return $bag;
    }
}
