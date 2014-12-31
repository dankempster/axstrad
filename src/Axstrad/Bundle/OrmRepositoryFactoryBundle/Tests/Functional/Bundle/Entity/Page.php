<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Why do I have to manually create these objects for Doctrine's
// annotation reader to find them when parsing this document???
new ORM\Column;
new ORM\Entity;
new ORM\Id;

/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\Entity\Page
 *
 * @ORM\Entity(repositoryClass="Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\Entity\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     * @var integer
     */
    protected $id;
}
