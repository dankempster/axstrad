<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional;

use Axstrad\Bundle\TestBundle\Functional\WebTestCase;
// use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\Tests\Functional\ServicesExistTest
 */
class ServicesExistTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider serviceExistsDataProvider
     */
    public function testServiceExists($serviceId)
    {
        $this->assertNotNull(
            static::$kernel
                ->getContainer()
                ->get($serviceId)
        );
    }

    public function serviceExistsDataProvider()
    {
        return array(
            array('axstrad.orm_repository_factory.factory'),

            array('axstrad.orm_repository_factory.orm_factory'),
        );
    }
}
