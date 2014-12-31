<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle\Factory;

use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory as RepositoryFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\Factory\RepositoryFactory
 */
class RepositoryFactory implements RepositoryFactoryInterface
{
    /**
     * @var array
     */
    private $serviceIds = array();

    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var Doctrine\ORM\Repository\RepositoryFactory
     */
    protected $defaultFactory;


    /**
     * @param array                      $serviceIds
     * @param Container                  $container
     * @param RepositoryFactoryInterface $defaultFactory
     */
    public function __construct(
        array $serviceIds,
        Container $container,
        RepositoryFactoryInterface $defaultFactory
    ) {
        $this->serviceIds = $serviceIds;
        $this->container = $container;
        $this->defaultFactory = $defaultFactory;
    }

    /**
     * @param  EntityManager $entityManager
     * @param  string        $entityName
     * @return Doctrine\ORM\EntityRepository
     */
    public function getRepository(EntityManager $entityManager, $entityName)
    {
        if (isset($this->serviceIds[$entityName])) {
            return $this->container->get($this->serviceIds[$entityName]);
        }

        return $this->defaultFactory->getRepository($entityManager, $entityName);
    }
}
