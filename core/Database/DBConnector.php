<?php


/*
| -------------------------------------------------------------------------
| PHPCodebooster Framework
| -------------------------------------------------------------------------
|
| User: spatel
| Date: 31/03/17
| Time: 11:06 AM
| Version: 1.0
| Website: http://www.phpcodebooster.com
*/
namespace PCB\Database;

abstract class DBConnector
{
    private static $connectors = [];

    private function __clone() {}
    private function __wakeup() {}
    private function __construct() {}

    public function get($type, $key, $configs=[])
    {
        $key = md5($type. '-' .$key);
        if ( !array_key_exists($key, self::$connectors) ) {
             $class_name = get_called_class();
             self::$connectors[$key] = new $class_name($configs);
        }

        return self::$connectors[$key];
    }
}