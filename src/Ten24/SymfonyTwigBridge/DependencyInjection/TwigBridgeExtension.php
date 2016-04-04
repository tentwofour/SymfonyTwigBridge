<?php

namespace Ten24\SymfonyTwigBridge\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class TwigBridgeExtension extends ConfigurableExtension
{
    /**
     * @var string
     */
    private $alias;

    /**
     * TwigBridgeExtension constructor.
     *
     * @param $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return \Ten24\SymfonyTwigBridge\DependencyInjection\TwigBundleConfiguration
     */
    public function getConfiguration(array $config,
                                     ContainerBuilder $container)
    {
        return new TwigBundleConfiguration($this->getAlias());
    }

    /**
     * @param array                                                   $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function loadInternal(array $configs,
                                 ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yml');
    }
}
