<?php

namespace IShop\Framework;

class Registry
{
    use TSingleton;

    private static $properties = [];

    public static function getProperty($key) 
    {
        return self::$properties[$key] ?? null;
    }

    public static function setProperty($key, $value)
    {
        self::$properties[$key] = $value;
    } 

    public static function getProperties()
    {
        return self::$properties;
    }
}

