<?php


/*
| -------------------------------------------------------------------------
| PHPCodebooster Framework
| -------------------------------------------------------------------------
|
| User: spatel
| Date: 31/03/17
| Time: 12:09 PM
| Version: 1.0
| Website: http://www.phpcodebooster.com
*/

namespace PCB\Services;

trait Singleton {

    private static $classes = [];

    private function __clone() {}
    private function __wakeup() {}

    public function getInstance()
    {
        $class_name = get_called_class();
        if ( !array_key_exists($class_name, self::$classes) ) {
             self::$classes[$class_name] = new $class_name();
        }

        return self::$classes[$class_name];
    }
}