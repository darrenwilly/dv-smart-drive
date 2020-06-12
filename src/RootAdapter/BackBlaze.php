<?php

namespace DV\SmartArrayDrive\RootAdapter;

use Mhetreramesh\Flysystem\BackblazeAdapter;
use BackblazeB2\Client;

class BackBlaze extends AbstractAdapter
{

    public function __invoke( $bucket='4d018a73aad2ad6d6be1001b')
    {
        ##
        $accountId = 'd1a3a2ddb10b' ;
        $applicationKey = '0015f9e39b753fab6536eed94c1e813c2e4d1cb0a4';
        ##
        $this->setRoot($bucket) ;
        ##
        $this->setOptions(['accountId' => $accountId , 'applicationKey' => $applicationKey]) ;

        ##
        $client = new Client($accountId, $applicationKey);
        ##

        $adapter = new BackblazeAdapter($client , strtolower($bucket));
        ##
        $this->setAdapter($adapter) ;
        ##
        return $this;
    }

    public function setName()
    {
        $this->name = 'backblaze' ;
    }

    public function setBaseurl()
    {

    }

}