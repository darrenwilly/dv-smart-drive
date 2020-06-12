<?php

namespace DV\SmartArrayDrive\Drive;

use DV\SmartArrayDrive\RootAdapter\Local;


class WebrootLocal extends AbstractDrive
{

    public function __invoke($root = WEBROOT_DIR)
    {
        ## call the base Local Adapater
        $adapter = new Local ;
        ## return the lOcal adapater with root configure
        $driveAdapter = $adapter($root)->getAdapter() ;
        ##
        $this->setAdapter($driveAdapter) ;
        ##
        return $this->getAdapter() ;
    }

    public function setDescription()
    {
        $this->description = 'Webroot Directory on the Local Web Server' ;
    }
}