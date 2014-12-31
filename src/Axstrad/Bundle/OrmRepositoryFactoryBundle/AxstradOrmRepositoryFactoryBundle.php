<?php
namespace Axstrad\Bundle\OrmRepositoryFactoryBundle;

use Axstrad\Bundle\OrmRepositoryFactoryBundle\DependencyInjection\Compiler\CompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


/**
 * Axstrad\Bundle\OrmRepositoryFactoryBundle\AxstradOrmRepositoryFactoryBundle
 */
class AxstradOrmRepositoryFactoryBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CompilerPass);
    }
}
