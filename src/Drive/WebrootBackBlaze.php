<?php

namespace DV\SmartArrayDrive\Drive;

use DV\SmartArrayDrive\RootAdapter\BackBlaze;

class WebrootBackBlaze extends AbstractDrive
{

    public function __invoke($root = 'emportal')
    {
        ## call the base Local Adapater
        $adapter = new BackBlaze() ;
        ## return the Digital adapater with root configure
        $driveAdapter = $adapter($root)->getAdapter() ;
        ##
        $this->setAdapter($driveAdapter) ;
        ##
        return $this->getAdapter() ;
    }

    public function setDescription()
    {
        $this->description = 'Webroot directory on BackBlaze B2 storage on Emplug bucket' ;
    }
}