<?php

namespace PCB\DBDrivers;

use PCB\App;

class MySQLConnector implements DBInterface
{
    private $conn = null;

    public function __construct($type, $key)
    {
        try {
            $db_configs  = App::config('database');
            $mysql_connection = !empty($db_configs['connections']['mysql']) ? $db_configs['connections']['mysql'] : [];

            if(!empty($mysql_connection))
            {
                $connection = !empty($mysql_connection['hosts'][$type][$key]) ? $mysql_connection['hosts'][$type][$key] : [];
                $this->conn = new \PDO("mysql:host={$connection}:3306;dbname={$mysql_connection['database']}", "{$mysql_connection['username']}", "{$mysql_connection['password']}");
            }
        }
        catch (\PDOException $ex) {
            exit("unable to connect with mysql -> {$type} -> {$key}");
        }
    }
}