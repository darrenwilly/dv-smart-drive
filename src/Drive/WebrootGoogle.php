<?php

namespace DV\SmartArrayDrive\Drive;

use DV\SmartArrayDrive\RootAdapter\Google;

class WebrootGoogle extends AbstractDrive
{

    public function __invoke($root = 'emplug')
    {
        ## call the base Local Adapater
        $adapter = new Google() ;
        ## return the Digital adapater with root configure
        $driveAdapter = $adapter()->getAdapter() ;
        ##
        $this->setAdapter($driveAdapter) ;
        ##
        return $this->getAdapter() ;
    }

    public function setDescription()
    {
        $this->description = 'Webroot directory on Google Cloud Storage using Emplug Bucket' ;
    }
}