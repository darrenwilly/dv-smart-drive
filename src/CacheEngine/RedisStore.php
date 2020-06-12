<?php

namespace DV\SmartArrayDrive\CacheEngine;

use Predis\Client as predisClient;

class RedisStore
{
    public function __invoke()
    {
        $client = new predisClient;
        ## call the flysystem storage
        $cacheStore = new PredisStore($client);
        ##
        return $cacheStore ;
    }
}