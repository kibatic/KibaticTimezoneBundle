<?php
namespace Kibatic\TimezoneBundle\Tests\App;

use Kibatic\TimezoneBundle\KibaticTimezoneBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Twig\Extra\TwigExtraBundle\TwigExtraBundle;

class AppKernelFull extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new FrameworkBundle(),
            new TwigBundle(),
            new KibaticTimezoneBundle(),
            new TwigExtraBundle()
        );
        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_full.yml');
    }
}
