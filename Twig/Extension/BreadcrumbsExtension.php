<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Twig\Extension;

use QualityPress\Bundle\BreadcrumbsBundle\Handler\BreadcrumbHandlerInterface;

/**
 * BreadcrumbsExtension
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class BreadcrumbsExtension extends \Twig_Extension
{
    
    protected $handler;
    
    public function __construct(BreadcrumbHandlerInterface $handler)
    {
        $this->handler = $handler;
    }
    
    public function getName()
    {
        return 'qp_breacrumbs';
    }

    public function getFunctions()
    {
        return array(
            'qp_breadcrumbs_render' => new \Twig_Function_Method($this, 'breadcrumbsRenderer', array("is_safe" => array("html"))),
            'qp_breadcrumbs_get'    => new \Twig_Function_Method($this, 'getBreadcrumbs', array("is_safe" => array("html"))),
        );
    }
    
    /**
     * Print a breadcrumb view
     * 
     * @param string $template
     * @param array $options
     * @return string Rendered view
     */
    public function breadcrumbsRenderer($template = null, array $options = array())
    {
        if (count($options))
            $this->handler->setOptions($options);
            
        return $this->handler->render($template);
    }
    
    /**
     * Get breadcrumbs
     * @return array Breadcrumbs
     */
    public function getBreadcrumbs()
    {
        return $this->handler->getBuilder()->getBreadcrumbs();
    }
    
}