<?php
namespace DV\SmartArrayDrive;

use League\Flysystem\AdapterInterface;
use League\Flysystem\MountManager;

class StorageFlexible
{
    const FIRST_CHOICE = 'first' ;
    const SECOND_CHOICE = 'second' ;
    const THIRD_CHOICE = 'third' ;

    protected $filesystem ;
    protected static $fsManager ;
    protected $_eventManager ;
    static protected $instance;
    protected $cloudStorageObject ;

    protected $filesystemAdaptionOptions ;

    public function implementedEvents()
    {
        return [

        ];
    }

    public function getEventManager()
    {

    }

    public function __construct($options=[])
    {
        $fsmanagerCallable = function($mountManager, $cloudStorageObject)   {
            ## set the cloudStorage Object
            $this->cloudStorageObject = $cloudStorageObject ;
            ## set the Manager here
            $this->setManager($mountManager) ;
            ## return back the mount manager
            return $mountManager ;
        } ;

        ##
        if(null == self::$fsManager)    {
            ##
            $cloudManager = new CloudStorageManager() ;
            ##
            self::$fsManager = $cloudManager($fsmanagerCallable)  ;
        }

        ## cross-check if the manager is still empty at this point
        if(null == $this->getManager())    {
            ##
            $this->setManager(self::$fsManager) ;
        }

    }

    /**
     * @return MountManager
     */
    public function getManager()
    {
        return self::$fsManager ;
    }
    public function setManager($manager)
    {
        self::$fsManager = $manager ;
    }


    static public function getInstance($options=[])
    {
        self::$instance = null;
        if (null === self::$instance) {
            self::$instance = new static($options);
        }
        ##
        return self::$instance;
    }



    public function putObject($options)
    {
        /**
         * 'ALC' => 'public-read',
        'Bucket' => $this->s3Config['bucket'],
        'SourceFile' => $path,
        'Key' => $key
         */
        $writeStreamOptions = [] ;
        $stream = '' ;

        if(isset($options['ALC']))    {
            ##
            if($options['ALC'] == 'public-read')    {
                $writeStreamOptions['visibility'] = AdapterInterface::VISIBILITY_PUBLIC ;
            }
            elseif($options['ALC'] == 'private')    {
                $writeStreamOptions['visibility'] = AdapterInterface::VISIBILITY_PRIVATE;
            }
        }

        ##
        if(isset($options['SourceFile']) && file_exists($options['SourceFile']))    {
            $stream = fopen($options['SourceFile'] , 'r+');
        }
        elseif(isset($options['stream']) && is_resource($options['stream']))  {
            ##
            $stream = $options['stream'];
        }
        else{
            ##
            throw new \InternalErrorException('Invalid data stream provided for upload') ;
        }

        ##
        $manager = $this->getManager() ;
        ##
        $firstAdapter = $manager->getFilesystem('first') ;

        ##
        $fileDescription = (string) call_user_func(function ()   use($options , $firstAdapter)  {
            ##
            if(isset($options['key']))    {
                return $options['key'] ;
            }

            elseif(isset($options['Key']))    {
                return $options['Key'] ;
            }

            elseif(isset($options['filePath']))    {
                return $options['filePath'] ;
            }

        }) ;

        ##
        $firstAdapter->writeStream($fileDescription , $stream , $writeStreamOptions) ;

        if (is_resource($stream)) {
            fclose($stream);
        }
    }

    public function deleteObject($options)
    {
        /**
         *  'Bucket' => $bucket,
        'Key' => $keyname
         */
        ##
        $manager = $this->getManager() ;
        ##
        $firstAdapter = $manager->getFilesystem('first') ;
        ##
        $fileDescription = (string) call_user_func(function ()   use($options , $firstAdapter)  {
            ##
            if(isset($options['key']))    {
                return $options['key'] ;
            }

            elseif(isset($options['Key']))    {
                return $options['Key'] ;
            }

            elseif(isset($options['filePath']))    {
                return $options['filePath'] ;
            }

        }) ;
        ##
        $firstAdapter->readAndDelete($fileDescription) ;
    }

}