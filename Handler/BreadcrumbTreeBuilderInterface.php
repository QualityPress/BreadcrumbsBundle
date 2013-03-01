<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Handler;

use QualityPress\Bundle\BreadcrumbsBundle\Model\BreadcrumbInterface;

/**
 * BreadcrumbTreeBuilderInterface
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
interface BreadcrumbTreeBuilderInterface
{
    
    /**
     * Create a new breadcrumb
     * 
     * @param string $name
     * @param string $link
     * @param array  $options
     * @return self
     */
    function add($name, $link = null, array $options = array());
    
    /**
     * Add an object to breadcrumb array
     * 
     * @param   BreadcrumbInterface $object
     * @param   integer $position
     * @return  self
     */
    function addObject(BreadcrumbInterface $object, $position = -1);
    
    /**
     * Replace breadcrumbs array
     * 
     * @param array $breadcrumbs
     * @return self
     */
    function setBreadcrumbs(array $breadcrumbs);
        
    /**
     * Remove an object or offset
     * void
     * 
     * @param integer|QualityPress\Bundle\BreadcrumbsBundle\Model\BreadcrumbInterface $offset
     */
    function removeObject($offset);
    
    /**
     * Replace an offset of breadcrumbs
     * void
     * 
     * @param integer $offset
     * @param integer $to
     */
    function replacePosition($offset, $to);
    
    /**
     * Get breadcrumbs
     * @return array
     */
    function getBreadcrumbs();
    
    /**
     * Get array of breadcrumbs and reset array
     * void
     * 
     * @return array
     */
    function getBreadcrumbsAndReset();
    
}
