<?php

namespace DV\SmartArrayDrive\ArrayDrive ;

use DV\SmartArrayDrive\CacheEngine\MemoryStore;
use DV\SmartArrayDrive\Drive\WebrootBackBlaze;
use DV\SmartArrayDrive\Drive\WebrootDigitalOcean;
use DV\SmartArrayDrive\TraitSmartArrayDrive;

class DualWebrootDigitalOceanBackBlaze extends AbstractSmartDrive
{
    use TraitSmartArrayDrive ;

    protected $hierachy = 1 ;
    protected $name = 'first' ;

    /**
     * mount DigitalOcean & BackBlaze as a replica Drive
     */
    public function __invoke($options=[])
    {
        ##
        $this->setSourceDrive(new WebrootDigitalOcean()) ;

        ##
        $this->setReplicaDrive(new WebrootBackBlaze()) ;

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