<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Configuration
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('quality_press_breadcrumbs');
        
        $rootNode
            ->children()
                ->scalarNode('class')
                    ->defaultValue('QualityPress\Bundle\BreadcrumbsBundle\Model\Breadcrumb')
                ->end()
                ->scalarNode('builder')
                    ->defaultValue('QualityPress\Bundle\BreadcrumbsBundle\Handler\BreadcrumbTreeBuilder')
                ->end()
                ->scalarNode('handler')
                    ->defaultValue('QualityPress\Bundle\BreadcrumbsBundle\Handler\BreadcrumbHandler')
                ->end()
                ->scalarNode('template')
                    ->defaultValue('QualityPressBreadcrumbsBundle::breadcrumbs.html.twig')
                ->end()
                
                ->arrayNode('options')
                    ->children()
                        ->scalarNode('separator')->defaultValue('|')->end()
                        ->scalarNode('translationDomain')->defaultNull()->end()
                        ->arrayNode('attr')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
    
}

/**
 * quality_press_breadcrumbs:
    class     : "QualityPress\Bundle\BreadcrumbsBundle\Model\Breadcrumb"
    builder   : "QualityPress\Bundle\BreadcrumbsBundle\Handler\BreadcrumbTreeBuilder"
    handler   : "QualityPress\Bundle\BreadcrumbsBundle\Handler\BreadcrumbHandler"
    template  : "QualityPressBreadcrumbsBundle::breadcrumbs.html.twig"
    
    options:
        separator         : "|"
        treeAttr          : 
            class: "breadcrumb"
        translationDomain : ~
 */