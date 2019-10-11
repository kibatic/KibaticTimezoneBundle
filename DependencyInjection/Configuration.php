<?php
namespace Kibatic\TimezoneBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('kibatic_timezone');

        $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('default_display_timezone')->end()
                ->scalarNode('timezone_provider')
                    ->defaultValue('kibatic_timezone.default_provider')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
