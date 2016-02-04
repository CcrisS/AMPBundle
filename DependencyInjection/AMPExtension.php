<?php
/**
 * AMPExtension.php
 *
 * Ariel Ferrandini <arielferrandini@gmail.com>
 * 13/01/16
 */
namespace Voc\AMPBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


class AMPExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
