<?php
namespace Kibatic\TimezoneBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('kibatic_timezone');
        $rootNode = $this->getRootNode($treeBuilder, 'kibatic_timezone');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('default_display_timezone')->end()
                ->scalarNode('timezone_provider')
                    ->defaultValue('kibatic_timezone.default_provider')
                ->end()
            ->end();

        return $treeBuilder;
    }

    private function getRootNode(TreeBuilder $treeBuilder, $name)
    {
        // BC layer for symfony/config 4.1 and older
        if (!\method_exists($treeBuilder, 'getRootNode')) {
            return $treeBuilder->root($name);
        }
        return $treeBuilder->getRootNode();
    }
}
