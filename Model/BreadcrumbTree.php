<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Model;

/**
 * BreadcrumbTree
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
abstract class BreadcrumbTree implements \ArrayAccess, \Countable
{
    
    protected $breadcrumbs = array();
    
    public function offsetExists($offset)
    {
        return isset($this->breadcrumbs[$offset]);
    }

    public function offsetGet($offset)
    {
        return ($this->offsetExists($offset)) ? $this->breadcrumbs[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $this->breadcrumbs[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->breadcrumbs[$offset]);
        }
    }

    public function count()
    {
        return (integer) count($this->breadcrumbs);
    }
    
}