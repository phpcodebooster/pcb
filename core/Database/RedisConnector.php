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

class RedisConnector extends DBConnector
{
    private $client = null;

    protected function __construct($configs=[])
    {
        try{
            $this->client = new \Predis\Client([
                'scheme'   => $configs['scheme'],
                'host'     => $configs['host'],
                'port'     => $configs['port'],
                'password' => $configs['password'],
            ]);
        }
        catch(\Exception $e) {
            exit($e->getMessage());
        }
    }
}