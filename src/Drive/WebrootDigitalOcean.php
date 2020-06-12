<?php

namespace DV\SmartArrayDrive\Drive;

use DV\SmartArrayDrive\RootAdapter\DigitalOcean;

class WebrootDigitalOcean extends AbstractDrive
{

    public function __invoke($root = 'emplug')
    {
        ## call the base Local Adapater
        $adapter = new DigitalOcean() ;
        ## return the Digital adapater with root configure
        $driveAdapter = $adapter($root)->getAdapter() ;
        ##
        $this->setAdapter($driveAdapter) ;
        ##
        return $this->getAdapter() ;
    }

    public function setDescription()
    {
        $this->description = 'Webroot directory on digital ocean using Emplug Bucket' ;
    }
}