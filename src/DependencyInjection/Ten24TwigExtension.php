<?php

namespace Ten24\Bundle\TwigBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class Ten24TwigExtension extends Extension
{
    /**
     * @param array                                                   $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config        = $this->processConfiguration($configuration, $configs);
        $loader        = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        foreach ($config as $key => $value) {
            if ($value) {
                $loader->load($key.'.yml');
            }
        }
    }
}
