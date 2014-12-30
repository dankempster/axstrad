<?php
namespace Axstrad\Bundle\HttpFileUploadBundle\Tests\Functional\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Axstrad\Bundle\HttpFileUploadBundle\Tests\Functional\Entity\Image
 *
 * @ORM\Entity()
 */
class Image extends File
{
    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    public $title;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    public $altText;

    /**
     * Get upload dir's web path.
     *
     * @return string
     */
    protected function getUploadDir()
    {
        return '/uploads/images';
    }
}
