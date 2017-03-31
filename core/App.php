<?php

namespace PCB;

session_start();

class App
{
    private static $root = null;
    private static $configs  = [];
    private static $services = [];
    private static $core_root = null;
    private static $app_root  = null;

    /**
     * Make sure to organize code in order of
     * Keys it matters and loads service in
     * Order they provided..
     *
     * @var array
     */
    private static $core_services = [
        'request'  => Services\Request::class,
        'response' => Services\Response::class,
        'router'   => Services\Router::class,
        'database' => Services\Database::class
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
        register_shutdown_function('custom_fatal_error');

        // load config files
        $finder = new \Symfony\Component\Finder\Finder();
        $finder->files()->in(self::$app_root. '/Configs');

        foreach ($finder as $file) {
            $config_key = str_replace('.php', '', $file->getRelativePathname());
            self::$configs[$config_key] = include_once $file->getRealPath();
        }

        // load services one by one
        foreach (self::$core_services as $key_name => $service) {
            self::$services[$key_name] = $service::getInstance();
        }
    }

    /**
     * @param $key
     * @return array|mixed
     */
    public static function config($key)
    {
        return array_key_exists($key, self::$configs) ? self::$configs[$key] : [];
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
     * Loading all the classes
     * using container approach..
     *
     * @param null $key
     * @return mixed
     */
    public static function get($key=null)
    {
        $key_name = $key ? strtolower($key) : 'app';
        $loaded_services = array_merge(self::$core_services, \App\Bootstrap::$services);

        // find the service from the provided list or return app instance
        $service = array_key_exists($key_name, $loaded_services) ? $loaded_services[$key_name] : get_called_class();

        if ( !array_key_exists($key_name, self::$services) ) {
             self::$services[$key_name] = new $service();
        }

        return self::$services[$key_name];
    }
}