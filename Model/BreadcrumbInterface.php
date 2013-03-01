<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Model;

interface BreadcrumbInterface
{

    /**
     * @param string $link
     * @return self
     */
    function setLink($link);

    /**
     * @return string
     */
    function getLink();
    
    /**
     * @param string $name
     * @return self
     */
    function setName($name);
    
    /**
     * @return string
     */
    function getName();
    
    /**
     * @param array $options
     * @return self
     */
    function setOptions($options);
    
    /**
     * @return array
     */
    function getOptions();

}