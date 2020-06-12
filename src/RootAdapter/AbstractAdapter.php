<?php

namespace DV\SmartArrayDrive\RootAdapter;

use DV\SmartArrayDrive\TraitAdapter;

abstract class AbstractAdapter
{
    use TraitAdapter ;

    protected $options;
    protected $rootOrBucketName;
    protected $name ;
    protected $baseUrl ;

    public function getOptions($options)
    {
        return $this->options ;
    }
    public function setOptions($options)
    {
        $this->options = $options ;
    }

    public function getRoot()
    {
        return $this->rootOrBucketName;
    }

    public function setRoot($root)
    {
        $this->rootOrBucketName = $root ;
    }

    public function getName()
    {
        return $this->getName() ;
    }
    abstract public function setName() ;

    public function getBaseUrl()
    {
        return $this->baseUrl() ;
    }
    abstract public function setBaseurl() ;
}