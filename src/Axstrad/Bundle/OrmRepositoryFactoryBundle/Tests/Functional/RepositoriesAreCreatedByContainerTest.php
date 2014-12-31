<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional;

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;
// use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\RepositoriesAreCreatedByContainerTest
 */
class RepositoriesAreCreatedByContainerTest extends WebTestCase
{
    protected $container;

    public function setUp()
    {
        parent::setUp();

        $this->container = self::$kernel->getContainer();
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
    }

    public function testRepositoryServiceExists()
    {
        $this->assertNotNull(
            $this->container->get('axstrad.test_orm_repository_factory.repository.page')
        );
    }

    /**
     * @depends testRepositoryServiceExists
     */
    public function testRepositoryHasSomeService()
    {
        $this->assertInstanceOf(
            'Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\SomeService',
            $this->container
                ->get('axstrad.test_orm_repository_factory.repository.page')
                ->getSomeService()
        );
    }


    /**
     * @sepends testRepositoryHasSomeService
     */
    public function testEntityManagerAndContainerReturnSameObject()
    {
        $this->assertSame(
            $this->entityManager->getRepository('Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\Bundle\Entity\Page'),
            $this->container->get('axstrad.test_orm_repository_factory.repository.page')
        );
    }
}
