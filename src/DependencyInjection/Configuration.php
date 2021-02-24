<?php

namespace Ten24\Bundle\TwigBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('ten24_twig');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('ten24_twig');
        }
        
        //@formatter:off
        $rootNode
            ->children()
                ->booleanNode('email')
                    ->info("Enable the email filters (email_encode)")
                ->end()
                ->booleanNode('diff')
                    ->info("Enable the diff functions (diff, diff_html)")
                ->end()
                ->booleanNode('inflector')
                    ->info("Enable the inflector filters (camelcase_to_capitalized_words, camelcase_to_sentence_case_words, camelcase_to_lower_case_words)")
                ->end()
                ->booleanNode('money')
                    ->info("Enable the money filters (cents_to_dollars)")
                ->end()
                ->booleanNode('number')
                    ->info("Enable the number filters (number_to_human_readable)")
                ->end()
            ->end()
        ->end();
        //@formatter:on

        return $treeBuilder;
    }
}
