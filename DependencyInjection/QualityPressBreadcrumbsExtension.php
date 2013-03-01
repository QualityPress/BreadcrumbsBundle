<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * QualityPressBreadcrumbsExtension
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class QualityPressBreadcrumbsExtension extends Extension
{
    
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $container->setParameter('quality_press.breadcrumbs.class', $config['class']);
        $container->setParameter('quality_press.breadcrumbs.builder', $config['builder']);
        $container->setParameter('quality_press.breadcrumbs.handler', $config['handler']);
        $container->setParameter('quality_press.breadcrumbs.template', $config['template']);
        
        $options = $config['options'];
        $container->setParameter('quality_press.breadcrumbs.options', $options);
        
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('breadcrumbs.xml');
    }

}