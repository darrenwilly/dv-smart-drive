<?php

namespace DV\SmartArrayDrive\Drive;

use DV\SmartArrayDrive\TraitAdapter;

abstract class AbstractDrive
{
    use TraitAdapter;

    protected $metadata;
    protected $description;

    public function getMetadata()
    {
        return $this->metadata ;
    }
    public function setMetadata($options=[])
    {
        return (array) call_user_func(function ()   use($options)   {
            ##
            $buildMetadata = [] ;
            ##
            $driveAdapter = $this->getAdapter() ;
            ##
            $buildMetadata['root-dir'] = $driveAdapter->getRoot() ;
            $buildMetadata['name'] = $driveAdapter->getName() ;
            $buildMetadata['driveOptions'] = $driveAdapter->getOptions() ;

            ## fetch description from the Drive itself and not its adapter
            $buildMetadata['description'] = $this->description ;
            ##
            return (0 < count($options)) ? array_merge($options , $buildMetadata) : $buildMetadata ;
        }) ;
    }

    public function getDescription()
    {
        return $this->description ;
    }
    abstract public function setDescription() ;
}