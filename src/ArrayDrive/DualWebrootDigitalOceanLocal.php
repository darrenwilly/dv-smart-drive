<?php

namespace DV\SmartArrayDrive\ArrayDrive;

use DV\SmartArrayDrive\CacheEngine\MemoryStore;
use DV\SmartArrayDrive\Drive\WebrootDigitalOcean;
use DV\SmartArrayDrive\Drive\WebrootLocal;
use DV\SmartArrayDrive\TraitSmartArrayDrive;

class DualWebrootDigitalOceanLocal extends AbstractSmartDrive
{
    use TraitSmartArrayDrive ;

    protected $hierachy = 2 ;
    protected $name = 'second' ;

    /**
     * mount DigitalOcean & Local as a replica Drive
     */
    public function __invoke($options=[])
    {
        ##
        $this->setSourceDrive(new WebrootDigitalOcean()) ;

        ##
        $this->setReplicaDrive(new WebrootLocal()) ;

        ##
        $cacheEngine = new MemoryStore ;

        ##
        return $this->createSmartDrive($this->getSourceDrive() , $this->getReplicaDrive() , ['cacheEngine' => $cacheEngine()]) ;
    }

    public function setDriveCount()
    {
        $this->driveCount = 2;
    }

}