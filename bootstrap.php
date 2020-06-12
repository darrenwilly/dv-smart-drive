<?php


if(! defined('DV_SMART_ARRAY_DRIVE_INITIALIZED'))    {
    ##
    define('DV_SMART_ARRAY_DRIVE_INITIALIZED' , 1) ;
}

if(! defined('DV_SMART_ARRAY_DRIVE_ROOT'))    {
    ##
    define('DV_SMART_ARRAY_DRIVE_ROOT' , __DIR__) ;
}

if(! defined('DV_SMART_ARRAY_DRIVE_EXTRA_CONFIG_FILE'))    {
    ##
    define('DV_SMART_ARRAY_DRIVE_EXTRA_CONFIG_FILE' , DV_SMART_ARRAY_DRIVE_ROOT.'/config/smart-array-drive.config.php') ;
}

if(! defined('WEBROOT_DIR'))    {
    ##
    define('WEBROOT_DIR' , 'webroot') ;
}

if(! getenv('GOOGLE_APPLICATION_CREDENTIALS') && ! defined('GOOGLE_APPLICATION_CREDENTIALS'))    {
    ##
    putenv(sprintf('%s=%s/google/emplug-storage-cloud-7ff966d862a6.json'  , 'GOOGLE_APPLICATION_CREDENTIALS' ,GLOBAL_ETC_PATH) );
}