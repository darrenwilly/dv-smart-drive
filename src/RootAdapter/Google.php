<?php

namespace DV\SmartArrayDrive\RootAdapter;

use Google\Cloud\Storage\StorageClient;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class Google extends AbstractAdapter
{

    public function __invoke()
    {
        ##
        $storageClient = new StorageClient([
            'projectId' => 'emplug-cloud',
        ]);
        $bucket = $storageClient->bucket('emportal');

        $adapter = new GoogleStorageAdapter($storageClient, $bucket);

        $this->setAdapter($adapter);
        ##
        return $this ;
    }

    public function setName()
    {
        $this->name = 'google-cloud' ;
    }

    public function setBaseurl()
    {
    }

}