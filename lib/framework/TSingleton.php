<?php

namespace IShop\Framework;

trait TSingleton
{
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance; 
    }
}
