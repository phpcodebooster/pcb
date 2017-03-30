<?php


namespace PCB\Services;

use PCB\App;
use PCB\DBDrivers\MySQLConnector;

class Database
{
    private static $connections  = [];

    public function boot()
    {
        $db_configs  = App::config('database');
        if(!$db_configs) {
            throw new \Exception('database config file is missing.');
        }

        // default to mysql conection
        $default_connection = !empty($db_configs['default']) ? $db_configs['default'] : 'mysql';

        // get all read/write connections
        if( !empty($db_configs['connections'][$default_connection]['hosts']) )
        {
            foreach ($db_configs['connections'][$default_connection]['hosts'] as $type => $connections)
            {
                foreach ($connections as $key => $configs)
                {
                    self::$connections[$type][$key] = new MySQLConnector($type, $key);
                }
            }
        }
    }

    /**
     * @param $key
     * @return null
     */
    public function read($key)
    {
        return array_key_exists($key, self::$connections['read']) ? self::$connections['read'][$key] : null;
    }

    /**
     * @param $key
     * @return null
     */
    public function write($key)
    {
        return array_key_exists($key, self::$connections['write']) ? self::$connections['write'][$key] : null;
    }
}