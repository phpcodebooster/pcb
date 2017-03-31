<?php


/*
| -------------------------------------------------------------------------
| PHPCodebooster Framework
| -------------------------------------------------------------------------
|
| User: spatel
| Date: 31/03/17
| Time: 11:07 AM
| Version: 1.0
| Website: http://www.phpcodebooster.com
*/
namespace PCB\Database;

class MySQLConnector extends DBConnector
{
    private $dbh = null;

    protected function __construct($configs=[])
    {
        try{
            $this->dbh = new \PDO("mysql:host={$configs['host']};dbname={$configs['database']}", $configs['username'], $configs['password']);
        }
        catch(\PDOException $e) {
            exit($e->getMessage());
        }
    }
}