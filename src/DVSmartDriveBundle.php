<?php

namespace DV\SmartArrayDrive;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DVSmartDriveBundle extends Bundle
{

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function boot(): void
    {
        /**
         * This will also be called in the service class,
         */
        if(! defined('DV_SMART_ARRAY_DRIVE_INITIALIZED'))    {
            ## load the bootstrap file
            $bootstrap = dirname(__DIR__) . '/bootstrap.php' ;
            ##
            if(! file_exists($bootstrap))    {
                throw new \RuntimeException('bootstrap file is required to initialized the Bundle for interopability purpose') ;
            }
            ##
            require $bootstrap ;
        }

        parent::boot();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container) ;

    }

    /**
     * When you choose to overwrite the default convention of using DepenencyInjection folder as extension
     * @return UnconventionalExtensionClass|null|\Symfony\Component\DependencyInjection\Extension\ExtensionInterface

    public function getContainerExtension()
    {
        return new UnconventionalExtensionClass();
    }*/
}