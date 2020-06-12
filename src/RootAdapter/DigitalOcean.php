<?php

namespace DV\SmartArrayDrive\RootAdapter;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DigitalOcean extends AbstractAdapter
{

    public function __invoke(ParameterBagInterface $containerConfig , $bucket='emplug')
    {
        ##
        $config = $containerConfig ;

        if(! isset($config['flysystem']['adapter']['digital-ocean']))    {
            #$config['flysystem']['adapter']['digital-ocean'] =

        }

        ##
        $options = $config['flysystem']['adapter']['digital-ocean'] ;

        $this->setOptions($options) ;

        ##
        $this->setRoot($bucket) ;

        ##
        $client = new S3Client($this->getOptions());

        ##
        $adapter = new AwsS3Adapter($client, strtolower($this->getRoot()));
        ##
        $this->setAdapter($adapter) ;
        ##
        return $this;
    }

    public function setName()
    {
        $this->name = 'digital-ocean' ;
    }

    public function setBaseurl()
    {

    }
}