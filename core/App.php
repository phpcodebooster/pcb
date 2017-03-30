<?php

namespace PCB;

session_start();

class App
{
    private static $root = null;
    private static $services = [];
    private static $core_root = null;
    private static $app_root  = null;
    private static $core_services = [
        'router'  => Services\Router::class,
        'request' => Services\Request::class,
        'response' => Services\Response::class
    ];

    private function __clone() {}
    private function __wakeup() {}

    /**
     * App constructor: initialize
     * the variables ..
     */
    private function __construct()
    {
        self::$core_root = __DIR__;
        self::$root = dirname(__DIR__);
        self::$app_root = dirname(__DIR__). '/app/';
    }

    /**
     * Loading all the classes
     * using container approach..
     *
     * @param null $key
     * @return mixed
     */
    public static function get($key=null)
    {
        $key_name = strtolower($key);
        $loaded_services = array_merge(self::$core_services, \App\Bootstrap::$services);

        // find the service from the provided list or return app instance
        $service = array_key_exists($key_name, $loaded_services) ? $loaded_services[$key_name] : get_called_class();
        if ( !array_key_exists($key_name, self::$services) ) {
              self::$services[$key_name] = new $service();
        }

        return self::$services[$key_name];
    }

    /**
     * @return null
     */
    public static function getCoreRoot()
    {
        return self::$core_root;
    }

    /**
     * @return null
     */
    public static function getAppRoot()
    {
        return self::$app_root;
    }

    /**
     * @return null|string
     */
    public static function getRoot()
    {
        return self::$root;
    }

    /**
     * Bootstrap our app
     */
    public function boot()
    {
        self::get('request')->boot();
        self::get('response')->boot();
        self::get('router')->boot();
    }
}