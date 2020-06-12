<?php

namespace DV\SmartArrayDrive;


trait TraitAdapter
{
    protected static $adapter ;

    public function getAdapter()
    {
        return self::$adapter ;
    }

    public function setAdapter($adapter)
    {
        self::$adapter = $adapter ;
    }
}