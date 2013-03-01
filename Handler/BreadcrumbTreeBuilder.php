<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Handler;

use QualityPress\Bundle\BreadcrumbsBundle\Model\BreadcrumbTree;
use QualityPress\Bundle\BreadcrumbsBundle\Model\BreadcrumbInterface;

/**
 * BreadcrumbTreeBuilder
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class BreadcrumbTreeBuilder extends BreadcrumbTree implements BreadcrumbTreeBuilderInterface
{
    
    protected $class;
    
    public function __construct($class)
    {
        $this->class = $class;
    }
    
    public function add($name, $link = null, array $options = array())
    {
        $object = new $this->class;
        $object
            ->setName($name)
            ->setLink($link)
            ->setOptions($options)
        ;
        
        if ($object->validateOptions())
            $this->offsetSet($this->count(), $object);
        
        return $this;
    }

    public function addObject(BreadcrumbInterface $object, $position = -1)
    {
        $position = (is_real($position) && $position !== '-1') ? $position : $this->count();        
        array_splice($this->breadcrumbs, $position, 0, array($object));
        
        return $this;
    }
    
    public function setBreadcrumbs(array $breadcrumbs)
    {
        foreach ($breadcrumbs as $key => $breadcrumb) {
            if (!$breadcrumb instanceof BreadcrumbInterface) {
                throw new \InvalidArgumentException(sprintf('The element %s must be instanced of BreadcrumbInterface', $key));
            }
            
            $this->addObject($breadcrumb, $key);
        }
        
        return $this;
    }
    
    public function replacePosition($offset, $to)
    {
        $breadcrumb = $this->offsetGet($offset);
        if (null !== $breadcrumb) {
            array_splice($this->breadcrumbs, $to, 0, $breadcrumb);
        }
    }
    
    public function removeObject($offset)
    {
        if (is_object($offset) && $offset instanceof BreadcrumbInterface) {
            foreach ($this->breadcrumbs as $key => $breadcrumb) {
                if (count(array_diff($breadcrumb, $offset))) {
                    $this->offsetUnset($key);
                    continue;
                }
            }
        }
        
        $this->offsetUnset($offset);
    }
    
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }
    
    public function getBreadcrumbsAndReset()
    {
        $array = $this->breadcrumbs;
        $this->breadcrumbs = array();
        
        return $array;
    }
    
}