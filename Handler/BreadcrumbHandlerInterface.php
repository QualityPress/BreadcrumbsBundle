<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Handler;

use QualityPress\Bundle\BreadcrumbsBundle\Handler\BreadcrumbTreeBuilderInterface;
use Symfony\Component\Templating\Helper\HelperInterface;

/**
 * BreadcrumbHandlerInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface BreadcrumbHandlerInterface
{
    
    /**
     * Get breadcrumbs tree builder
     * @return BreadcrumbTreeBuilderInterface
     */
    function getBuilder();
    
    /**
     * Define general options
     * @param array $options
     */
    function setOptions(array $options);
    
    /**
     * Render breadcrumbs template
     * @return string rendered template
     */
    function render($template = null);
    
}
