<?php

namespace DV\SmartArrayDrive\RootAdapter;

use League\Flysystem\Adapter\Local as flysystemLocalAdapter;

class Local extends AbstractAdapter
{

    public function __invoke($root = WEBROOT_DIR , $options=[])
    {
        ##
        $this->setRoot($root) ;
        ##
        $options = ['root' => $root , 'writeFlag' => 0 , 'link' => flysystemLocalAdapter::DISALLOW_LINKS ,
                    'permission' => [
                        'file' => [
                            'public' => 0744,
                            'private' => 0700,
                        ],
                        'dir' => [
                            'public' => 0755,
                            'private' => 0700,
                        ]
                    ]
        ] ;

        ##
        $this->setOptions($options) ;

        ##
        extract($options) ;

        ##
        $adapter = new flysystemLocalAdapter($root , $writeFlag ,$link , $permission) ;
        ##
        $this->setAdapter($adapter) ;
        ##
        return $this;
    }

    public function setName()
    {
        $this->name = 'local-webroot' ;
    }

    public function setBaseurl()
    {
        $this->baseUrl = FULL_BASE_LOCAL_URL ;
    }

}