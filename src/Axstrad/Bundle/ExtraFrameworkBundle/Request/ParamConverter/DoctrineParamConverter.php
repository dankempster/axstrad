<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @package Axstrad\Bundle\ExtraFrameworkBundle
 */
namespace Axstrad\Bundle\ExtraFrameworkBundle\Request\ParamConverter;

use Doctrine\Common\Persistence\ManagerRegistry;
use PhpOption\Option as PhpOption;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter as ParamConverterConfig;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter as SensioDoctrineParamConverter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Axstrad\Bundle\ExtraFrameworkBundle\Request\ParamConverter\DoctrineParamConverter
 *
 * Extends the standard DoctrineParamConverter so that the Doctrine Entity classname can be specified as a DI container
 * paramerter. Also if the Repository returns a PhpOption\Option object, it's value will be extracted and returned or a
 * NotFoundException will be thrown.
 */
class DoctrineParamConverter extends SensioDoctrineParamConverter
{
    /**
     * @var ContainerInterface
     */
    protected $container = null;

    /**
     * Class constructor
     *
     * @param ContainerInterface $container The application's DI Container
     */
    public function __construct(ManagerRegistry $manager, ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct($manager);
    }

    /**
     * @uses convertClassParamToClassName
     */
    public function apply(Request $request, ConfigurationInterface $configuration)
    {
        $this->convertClassParamToClassName($configuration);

        return parent::apply($request, $configuration);
    }

    /**
     * @uses convertClassParamToClassName
     */
    public function supports(ConfigurationInterface $configuration)
    {
        $this->convertClassParamToClassName($configuration);

        return parent::supports($configuration);
    }

    /**
     * Converts a Class parameter to a class name
     *
     * If <em>configuration</em>->getClass() matches /%(.*)%/ then it is interpreted as a DI container parameter; And
     * the DI container is asked for a parameter value using $1 (from the regex) as the key.
     *
     * @param ConfigurationInterface $configuration
     * @return void
     */
    protected function convertClassParamToClassName(ConfigurationInterface $configuration)
    {
        if (!$configuration instanceof ParamConverterConfig) {
            return;
        }

        if (preg_match('/^%(.*)%$/', $configuration->getClass(), $matches)) {
            $param = $this->container->getParameter($matches[1]);
            $configuration->setClass($param);
        }
    }
}
