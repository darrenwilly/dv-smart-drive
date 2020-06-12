<?php
namespace DV\SmartArrayDrive;

use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\ListPaths;
use League\Flysystem\Plugin\ListWith;

class MasterFileSystem
{

    public function __invoke($smartDrive , $options=[])
    {
        $filesystem = new Filesystem($smartDrive , $options) ;
        ##
        $filesystem->addPlugin(new ListWith());
        $filesystem->addPlugin(new ListPaths());

        /*$config = getPsr11Container('config') ;
        ##
        if(isset($config['flysystem']['plugins']))    {
            ##
            $options['plugins'] = array_merge_recursive($options['plugins']  , $config['flysystem']['plugins']) ;
        }

        ##
        if($options['plugins'])    {
            ##
            $plugin = (array) $options['plugins'] ;
            ##
            foreach ($plugin as $item)  {
                ##
                $filesystem->addPlugin($item) ;
            }
        }*/
        ##
        return $filesystem ;
    }

}