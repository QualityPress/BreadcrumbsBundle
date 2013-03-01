<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Handler;

use QualityPress\Bundle\BreadcrumbsBundle\Exception\InvalidOptionException;
use QualityPress\Bundle\BreadcrumbsBundle\Model\BreadcrumbTreeInterface;
use QualityPress\Bundle\BreadcrumbsBundle\Model\BreadcrumbInterface;
use Symfony\Component\Templating\Helper\HelperInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Manipulator
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class BreadcrumbHandler implements BreadcrumbHandlerInterface
{
 
    /**
     * @var ContainerInterface 
     */
    protected $container;
    
    /**
     * @var array
     */
    protected $options;
    
    /**
     * @var string
     */
    protected $template;
    
    /**
     * @var array
     */
    protected $optionTypes = array(
        'separator', 'translationDomain', 'attr'
    );
    
    public function __construct(ContainerInterface $container, $template, array $options)
    {
        $this->container    = $container;
        $this->template     = $template;
        $this->options      = array(
            'translationDomain' => '',
            'separator' => '',
            'attr' => array()
        );
        
        $this->setOptions($options);
    }
        
    public function getBuilder()
    {
        return $this->container->get('qp_breadcrumbs.builder');
    }
    
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            if (in_array($key, $this->optionTypes))
                $this->options[$key] = $value;
            else
                throw new InvalidOptionException(sprintf(
                    'The option "%s" was not found. Current option types are: %s',
                    $key,
                    join(',', $this->optionTypes)
                ));
        }
    }

    public function render($template = null)
    {
        $breadcrumbs    = $this->getBuilder()->getBreadcrumbs();
        $template       = (null === $template) ? $this->template : $template;
        
        return $this->container->get('templating')->render($template, array(
            'breadcrumbs'   => $breadcrumbs,
            'options'       => $this->options
        ));
    }
    
}