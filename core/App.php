<?php

namespace PCB;

session_start();

class App
{
    private static $services = [];
    private static $core_services = [
        'router'  => Services\Router::class,
        'request' => Services\Request::class
    ];

    private function __clone() {}
    private function __wakeup() {}

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
     * Bootstrap our app
     */
    public static function boot()
    {
        self::get('request')->boot();
        self::get('router')->boot();
    }
}