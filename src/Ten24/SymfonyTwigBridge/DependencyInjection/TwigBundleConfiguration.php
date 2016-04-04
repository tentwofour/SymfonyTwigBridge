<?php

namespace Ten24\SymfonyTwigBridge\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class TwigBundleConfiguration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * TwigBundleConfiguration constructor.
     *
     * @param $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root($this->alias);

        return $treeBuilder;
    }
}
