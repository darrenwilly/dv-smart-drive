<?php

namespace DV\SmartArrayDrive\ArrayDrive ;

use DV\SmartArrayDrive\CacheEngine\MemoryStore;
use DV\SmartArrayDrive\Drive\WebrootBackBlaze;
use DV\SmartArrayDrive\Drive\WebrootGoogle;
use DV\SmartArrayDrive\TraitSmartArrayDrive;

class DualWebrootGoogleBackBlaze extends AbstractSmartDrive
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
        $this->setSourceDrive(new WebrootGoogle()) ;

        ##
        $this->setReplicaDrive(new WebrootBackBlaze()) ;

        ##
        $cacheEngine = new MemoryStore() ;
        ##
        $options = array_merge($options , ['cacheEngine' => $cacheEngine()]) ;
        ##
        $this->setOptions($options) ;

        ##
        return $this->createSmartDrive($this->getSourceDrive() , $this->getReplicaDrive() , $this->getOptions()) ;
    }

    public function setDriveCount()
    {
        $this->driveCount = 2;
    }
}