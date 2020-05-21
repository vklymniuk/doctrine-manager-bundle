<?php

namespace VK\DoctrineManagerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use VK\DoctrineSpecification\EntitySpecificationRepository;

/**
 * Class DtDoctrineManagerExtension
 */
class DtDoctrineManagerExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $container->setParameter('env(APP__PAGINATION_LIMIT)', 25);
        $loader->load('services.yml');
    }
}
