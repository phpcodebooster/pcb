<?php


namespace PCB\Services;

use PCB\App;
use PCB\Database\MySQLConnector;
use PCB\Database\RedisConnector;

class Database
{
    use Singleton;

    private static $redis_connections = [];
    private static $mysql_connections = [];

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $db_configs  = App::config('database');
        if(!$db_configs) {
            throw new \Exception('database config file is missing.');
        }

        // get all read/write connections
        if( !empty($db_configs['mysql']) )
        {
            foreach ($db_configs['mysql'] as $type => $connections)
            {
                foreach ($connections as $key => $configs)
                {
                    self::$mysql_connections[$type][$key] = new \PDO("mysql:host={$configs['host']};dbname={$configs['database']}", $configs['username'], $configs['password']);
                }
            }
        }

        if( !empty($db_configs['redis']) )
        {
            foreach ($db_configs['redis'] as $type => $config)
            {
                self::$redis_connections[$type] = new \Predis\Client([
                    'scheme'   => $config['scheme'],
                    'host'     => $config['host'],
                    'port'     => $config['port'],
                    'password' => $config['password'],
                ]);
            }
        }
    }

    /**
     * @param string $key
     * @return null
     */
    public function getRedisConnection($key='default')
    {
        return array_key_exists($key, self::$redis_connections) ? self::$redis_connections[$key] : null;
    }

    /**
     * @param string $key
     * @return null
     */
    public function getMySQLReadConnection($key='default')
    {
        return array_key_exists($key, self::$mysql_connections['read']) ? self::$mysql_connections['read'][$key] : null;
    }

    /**
     * @param string $key
     * @return null
     */
    public function getMySQLWriteConnection($key='default')
    {
        return array_key_exists($key, self::$mysql_connections['write']) ? self::$mysql_connections['write'][$key] : null;
    }
}