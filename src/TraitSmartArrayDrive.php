<?php

namespace DV\SmartArrayDrive;

use League\Flysystem\Cached\CachedAdapter;
use League\Flysystem\Replicate\ReplicateAdapter;

trait TraitSmartArrayDrive
{

    /**
     * mount DigitalOcean & BackBlaze as a replica Drive
     * @source must be valid adapter source define in the Adapter namespace
     * @replica must be valid adapter source define in the Adapter namespace
     */
    public function createSmartDrive($sourceAdapter , $replicaAdapter , $options=[])
    {
        ## incase a callable object is passed instead of object
        if(is_callable($sourceAdapter))    {
            $sourceAdapter = $sourceAdapter() ;
        }

        ## incase a callable object is passed instead of object
        if(is_callable($replicaAdapter))    {
            $replicaAdapter = $replicaAdapter() ;
        }
        ##
        $smartdrive = new ReplicateAdapter($sourceAdapter, $replicaAdapter);

        /**
         * When the cacheEngine is set which must be the instance of CacheEngineInterface then the cache is applied to the Replica Adapter
         */
        if(isset($options['cacheEngine']))    {
            ##
            $cacheEngineStorage = $options['cacheEngine'] ;
            ##
            $smartdrive = new CachedAdapter($smartdrive , $cacheEngineStorage) ;
        }

        ##
        $flysystemOptions = [] ;

        if($options['flysystemOptions'])    {
            ##
            $flysystemOptions = $options['flysystemOptions'] ;
        }

        ## calling our master flysystem where we can apply a centra setting for all flystem
        $flysystem = new MasterFileSystem ;
        ##
        return $flysystem($smartdrive , $flysystemOptions) ;
    }

}