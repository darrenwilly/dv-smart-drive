<?php

namespace DV\SmartArrayDrive\ArrayDrive;


use DV\SmartArrayDrive\Drive\AbstractDrive;
use DV\SmartArrayDrive\ArrayDrive\InvalidSmartDriveException;

abstract class AbstractSmartDrive
{

    protected $hierrachy = 3;
    protected $name = 'third' ;
    protected $sourceDrive ;
    protected $replicaDrive  ;
    protected $driveCount ;
    protected $options ;

    public function getHierrachy()
    {
        return $this->hierrachy ;
    }
    public function setHierrachy($hierrachy)
    {
        $this->hierrachy = $hierrachy ;
    }

    public function getOptions()
    {
        return $this->options ;
    }
    public function setOptions($options)
    {
        $this->options = $options ;
    }

    public function getName()
    {
        return $this->name ;
    }
    public function setName($name)
    {
        $this->name = $name ;
    }

    public function getDriveMetadatas($key=null , $position='source')
    {
        $drive = null ;
        switch ($position)   {
            case 'replica' :
                $drive = $this->getReplicaDrive() ;
                break;
            case 'source':
                $drive = $this->getSourceDrive() ;
                break;

            default:
                /**
                 * if the position is not provider then fetch the metadata in both drive
                 */
                $drive[] = $this->getSourceDrive() ;
                $drive[] = $this->getReplicaDrive() ;
        }
        ##
        if(! $drive instanceof AbstractDrive)    {
            ## and if it is not an array or Abstract drive
            if(! is_array($drive))    {
                throw new InvalidSmartDriveException('Only instance of Smart Drive are allowed, which can return the details of their connection') ;
            }
        }

        ##
        $metadata = call_user_func(function() use($drive) {
            ##
            if(is_array($drive))    {
                ##
                $multiMetadata = [] ;
                ##
                foreach ($drive as $dItem)  {
                    if(! $drive instanceof AbstractDrive)    {
                        throw new InvalidSmartDriveException('Only instance of Smart Drive are allowed, which can return the details of their connection') ;
                        break;
                    }
                    ##
                    $multiMetadata = array_merge($multiMetadata , $dItem->getMetadata()) ;
                }
                ##
                return $multiMetadata ;
            }

            ##
            return $drive->getMetadata() ;
        }) ;

        ##
        if(isset($metadata[$key]))    {
            ##
            return $metadata[$key] ;
        }

        return $metadata ;
    }

    public function setSourceDrive($drive)
    {
        $this->sourceDrive = $drive ;
    }

    public function getSourceDrive()
    {
        $drive = $this->sourceDrive ;
        ##
        if(is_callable($drive))    {
            return $drive() ;
        }
        return $drive ;
    }

    public function setReplicaDrive($drive)
    {
        $this->replicaDrive = $drive ;
    }

    public function getReplicaDrive()
    {
        $drive = $this->replicaDrive ;
        if(is_callable($drive))    {
            return $drive() ;
        }
        return $drive ;
    }

    public function getDriveCount()
    {
        return (int) $this->driveCount;
    }
    abstract public function setDriveCount() ;

}