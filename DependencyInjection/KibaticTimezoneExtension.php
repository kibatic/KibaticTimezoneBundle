<?php
namespace Kibatic\TimezoneBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class KibaticTimezoneExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');

        $definition = $container->getDefinition('kibatic_timezone.adjuster');
        $definition->replaceArgument(0, $config['default_display_timezone']);
        $definition->replaceArgument(1, new Reference($config['timezone_provider']));
    }
}
