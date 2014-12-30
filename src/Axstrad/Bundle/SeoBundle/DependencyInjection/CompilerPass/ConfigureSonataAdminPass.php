<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\Bundle\SeoBundle\DependencyInjection\CompilerPass;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;


/**
 * Axstrad\Bundle\SeoBundle\DependencyInjection\CompilerPass\ConfigureSonataAdminPass
 *
 * Loads SymfonyCMF's SEO admin configure when ORM persistence is enabled.
 * The Seo bundle contains a bug which prevents it from doing this itself.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @license MIT
 * @package Axstrad/SeoBundle
 * @subpackage Admin
 */
class ConfigureSonataAdminPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->getParameter('cmf_seo.backend_type_orm') == true
            && !$container->hasDefinition('cmf_seo.admin_extension')
        ) {
            $this->loadCmfSeoSonataAdmin($container);
        }
    }

    protected function loadCmfSeoSonataAdmin(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');
        $r = new \ReflectionClass($bundles['CmfSeoBundle']);
        $container->getExtension('cmf_seo')->loadSonataAdmin(
            array(
                'enabled' => true,
                'form_group' => 'form.group_seo'
            ),
            new XmlFileLoader($container, new FileLocator(dirname($r->getFileName()).'/Resources/config')),
            $container,
            array( )
        );
    }
}
