<?php

namespace DV\SmartArrayDrive\ArrayDrive;

use DV\SmartArrayDrive\CacheEngine\MemoryStore;
use DV\SmartArrayDrive\Drive\WebrootBackBlaze;
use DV\SmartArrayDrive\Drive\WebrootLocal;
use DV\SmartArrayDrive\TraitSmartArrayDrive;

class DualWebrootBackBlazeLocal extends AbstractSmartDrive
{
    use TraitSmartArrayDrive ;

    /**
     * mount DigitalOcean & Local as a replica Drive
     */
    public function __invoke($options=[])
    {
        ##
        $sourceDrive = new WebrootBackBlaze() ;

        ##
        $replicaDrive = new WebrootLocal() ;

        ##
        $cacheEngine = new MemoryStore ;

        ##
        return $this->createSmartDrive($sourceDrive() , $replicaDrive() , ['cacheEngine' => $cacheEngine()]) ;
    }

    public function setDriveCount()
    {
        $this->driveCount = 2;
    }

}