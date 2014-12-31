<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\Entity;

use Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\SomeService;
use Doctrine\ORM\EntityRepository;


/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\Entity\PageRepository
 *
 * @ORM\Entity(repositoryClass="")
 */
class PageRepository extends EntityRepository
{
    /**
     * @param SomeService $service
     */
    public function setSomeService(SomeService $service)
    {
        $this->service = $service;
    }

    public function getSomeService()
    {
        return $this->service;
    }
}
