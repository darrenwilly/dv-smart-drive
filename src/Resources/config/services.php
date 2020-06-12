<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator ;

/**
 * This will also be called in the service class, Alway remember to exclude the Resources folder from the $this->>registerClasses to avoid call this file as a class
 * the problem can be very annoying
 */
if(! defined('DV_SMART_ARRAY_DRIVE_INITIALIZED'))    {
    ## load the bootstrap file
    $bootstrap = (dirname(dirname(__DIR__))) . '/bootstrap.php' ;
    ##
    if(! file_exists($bootstrap))    {
        throw new \RuntimeException('bootstrap file is required to initialized the Bundle for interopability purpose') ;
    }
    ##
    require $bootstrap ;
}

return function(ContainerConfigurator $configurator)    {
    ## default configuration for services in *this* file
    $services = $configurator->services()
        ->defaults()
        ->autowire()      // Automatically injects dependencies in your services.
        ->autoconfigure() // Automatically registers your services as commands, event subscribers, etc.
        ->public();
    ##
    #$configurator->import(__DIR__.'/autoload/*.php');

    ##
    /*$services->load('DV\\SmartArrayDrive\\' , DV_SMART_ARRAY_DRIVE_ROOT.'/src/*')
                ->exclude(DV_SMART_ARRAY_DRIVE_ROOT . '/src/{DependencyInjection,Entity,Migrations,Tests,Kernel.php}');*/
    try{
    }
        catch (\Throwable $exception)   {
        dump($exception); exit;
    }
    ##
    return $services;
};
