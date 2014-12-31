<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\DependencyInjection\Compiler\CompilerPass
 */
class CompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $repositoryIds = [];
        $taggedRepos = $container->findTaggedServiceIds('axstrad.orm_repository');

        foreach ($taggedRepos as $repoId => $params) {
            foreach ($params as $param) {
                $repositoryIds[$param['entity']] = $repoId;

                // Create a reference to the entity manager
                if (empty($param['manager'])) {
                    $param['manager'] = 'doctrine.orm.entity_manager';
                }
                $manager = new Reference($param['manager']);

                // Define the entity's ClassMetaData object
                $classMetaData = new Definition;
                $classMetaData
                    ->setClass('Doctrine\ORM\Mapping\ClassMetadata')
                    ->setFactoryService($manager)
                    ->setFactoryMethod('getClassMetadata')
                    ->setArguments(array($param['entity']))
                ;

                // Inject the $manager and $classMetaData definitions as the
                // first and second constructor arguments for the repository
                // definition.
                $repository = $container->findDefinition($repoId);
                $repository->setArguments(array_merge(
                    array(
                        $manager,
                        $classMetaData
                    ),
                    $repository->getArguments()
                ));
            }
        }

        // Set the repository IDs to the Repository factory
        $factory = $container->findDefinition('axstrad.orm_repository_factory.factory');
        $factory->replaceArgument(0, $repositoryIds);

        // Tell Doctrine about our repository factory
        $container
            ->findDefinition('doctrine.orm.configuration')
            ->addMethodCall('setRepositoryFactory', [$factory])
        ;
    }
}
