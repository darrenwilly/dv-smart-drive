<?php
namespace DV\SmartArrayDrive;

use DV\SmartArrayDrive\ArrayDrive\AbstractSmartDrive;
use League\Flysystem\MountManager;

class CloudStorageManager
{
    static protected $storage;
    static protected $manager;
    protected $smartDrive;

    protected $defaultFilesystem = 'first' ;


    static public function getInstance()
    {
        if(null == self::$manager)    {
            ##
            $self = new static() ;
            ##
            return $self ;
        }
    }


    public function __invoke(callable $callable=null)
    {
        ## instantiate a new cloud system mount manager
        $filesystemManager = new MountManager();
        ##
        /*$config = getPsr11Container('config') ;
        ## fetch the smart drive that are configure and once they are found, they are automounted to the Mountmanager
        if(isset($config['flysystem']['smart-drive']))    {
            ##
            $smartDrive = (array) $config['flysystem']['smart-drive'] ;
            ##
            foreach ($smartDrive as $name => $item)  {
                ##
                if(is_string($item) && is_callable($item))    {
                    ##
                    $itemInstance = new $item ;
                    ##
                    $item = $itemInstance() ;
                }
                ##
                $this->setSmartDrive($itemInstance , trim($name)) ;
                ## mount the smart drive describe in the config
                $filesystemManager->mountFilesystem(trim($name) , $item) ;
            }
        }*/

        ##
        $this->setManager($filesystemManager) ;

        ## when callable is passed a value, return the callable
        if(is_callable($callable))    {
            ##
            return call_user_func($callable , $filesystemManager , $this) ;
        }
        ## else return the instance of the mountManager
        return $this ;
    }

    public function getManager()
    {
        return self::$manager ;
    }
    public function setManager($manager)
    {
        self::$manager = $manager ;
    }

    /**
     * @param AbstractSmartDrive $drive
     * @param null $key
     * @return mixed
     */
    public function setSmartDrive($drive , $key=null)
    {
        return $this->smartDrive[$key] = (is_callable($drive)) ? $drive() : $drive;
    }
    /**
     * Return the array instance of each SmartDrive
     * @return array
     */
    public function getSmartDrive()
    {
        return $this->smartDrive ;
    }
}