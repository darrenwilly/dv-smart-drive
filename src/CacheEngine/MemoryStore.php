<?php
namespace DV\SmartArrayDrive\CacheEngine;

use League\Flysystem\Cached\Storage\Memory as MemoryStoreCache;

class MemoryStore
{

    public function __invoke()
    {
        $cacheStore = new MemoryStoreCache();
        ##
        return $cacheStore ;
    }
}