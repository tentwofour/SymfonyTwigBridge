<?php

namespace Ten24\SymfonyTwigBridge\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * Configuration constructor.
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
        $rootNode    = $treeBuilder->root($this->alias);

        //@formatter:off
        $rootNode
            ->children()
                ->booleanNode('email')
                    ->defaultTrue()
                ->end()
                ->booleanNode('diff')
                    ->defaultTrue()
                ->end()
                ->booleanNode('money')
                    ->defaultTrue()
                ->end()
                ->booleanNode('number')
                    ->defaultTrue()
                ->end()
            ->end()
        ->end();
        //@formatter:on

        return $treeBuilder;
    }
}
