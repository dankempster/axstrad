<?php
namespace Axstrad\Bundle\HttpFileUploadBundle\Entity;

use Axstrad\Bundle\HttpFileUploadBundle\Model\BaseFile;
use DateTime;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Axstrad\Bundle\HttpFileUploadBundle\Entity\File
 *
 * See src/Axstrad/Bundle/HttpFileUploadBundle\Resources\config\orm\File.yml for
 * mapping.
 */
class File extends BaseFile
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var DateTime
     */
    protected $fileUpdatedAt;

    /**
     * @var null|string
     */
    protected $oldPath;

    /**
     * Get fileUpdatedAt
     *
     * @param null|string $format A format excepted by
     *        {@link http://www.php.net/manual/en/function.date.php date()}
     * @return string|DateTime A DateTime object if $format is null, a datetime
     *         string otherwise.
     * @see setFileUpdatedAt
     */
    public function getFileUpdatedAt($format = null)
    {
        if ($this->fileUpdatedAt instanceof DateTime) {
            if (!empty($format)) {
                return $this->fileUpdatedAt->format($format);
            }
            else {
                return clone $this->fileUpdatedAt;
            }
        }
        else {
            return null;
        }
    }

    /**
     * Set fileUpdatedAt
     *
     * @param null|DateTime|string $fileUpdatedAt A DateTime Object or a datetime string
     *        that's excepted by
     *        {@link http://www.php.net/manual/en/function.date.php date()}
     * @return self
     * @see getFileUpdatedAt
     */
    public function setFileUpdatedAt($fileUpdatedAt)
    {
        if ($fileUpdatedAt === null) {
            $this->fileUpdatedAt = null;
        }
        elseif ($fileUpdatedAt instanceof DateTime) {
            $this->fileUpdatedAt = clone $fileUpdatedAt;
        }
        else {
            $this->fileUpdatedAt = new DateTime((string) $fileUpdatedAt);
        }
        return $this;
    }


    /**
     */
    public function setFile(UploadedFile $file = null)
    {
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->oldPath = $this->getPath();
            $this->setPath(null);
        }

        return parent::setFile($file);
    }

    /**
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));

            // do whatever you want to generate a unique name
            $this->setPath($filename.'.'.$this->getFile()->guessExtension());
        }
    }

    /**
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->getPath());

        // check if we have an old file
        if (isset($this->oldPath)) {
            // delete the old file
            unlink($this->getUploadRootDir().DIRECTORY_SEPARATOR.$this->oldPath);
            // clear the old file path
            $this->oldPath = null;
        }
        $this->file = null;
    }

    /**
     * Deletes the entity's file from the filesystem.
     *
     * @return null|boolean Returns NULL if there is no file to delete, TRUE on
     *         success or FALSE on failure.
     */
    public function removeUpload()
    {
        $path = $this->getAbsolutePath();
        if (!empty($path) && file_exists($path)) {
            return unlink($path);
        }
        return null;
    }
}
