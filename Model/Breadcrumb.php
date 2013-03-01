<?php

namespace QualityPress\Bundle\BreadcrumbsBundle\Model;

use QualityPress\Bundle\BreadcrumbsBundle\Exception\InvalidOptionException;

class Breadcrumb implements BreadcrumbInterface
{

    protected $name;
    protected $link;
    protected $options;
    protected $permittedOptions;
    
    public function __construct()
    {
        $this->options = array('attr' => array(), 'linkAttr' => array());
        $this->permittedOptions = array('attr', 'linkAttr');
    }
    
    public function getLink()
    {
        return $this->link;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function setOptions($options)
    {
        foreach ($options as $key => $option)
            $this->options[$key] = $option;
        
        return $this;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * Loop into $options to verify individual option validation
     */
    public function validateOptions()
    {
        foreach ($this->options as $key => $option) {
            strtolower($key);
            if (false === $this->isOptionValid($key, $option)) {
                throw new InvalidOptionException(sprintf(
                    'The informed "option" are invalid, "%s" is not found on permitted options. We found these options: %s',
                    $key,
                    join(',', $this->getPermittedOptions())
                ));
            }
        }
        
        return true;
    }
    
    /**
     * Validate an option
     * @param string $key
     * @param mixed $option
     */
    protected function isOptionValid($key, $option) 
    {
        return (true == in_array($key, $this->getPermittedOptions()) && is_array($option));
    }
    
    /**
     * @return array Valid option types
     */
    protected function getPermittedOptions()
    {
        return $this->permittedOptions;
    }
    
    public function __toString()
    {
        return $this->getName();
    }

}