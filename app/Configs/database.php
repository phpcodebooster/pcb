<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
    'mysql' => [
        'read' => [
            'default' => [
                'host'      => '127.0.0.1',
                'username'  => 'root',
                'password'  => 'root',
                'database'  => 'pcb'
            ]
        ],
        'write' => [
            'default' => [
                'host'      => '127.0.0.1',
                'username'  => 'root',
                'password'  => 'root',
                'database'  => 'pcb'
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */
    'redis' => [
        'default' => [
            'host'     => '127.0.0.1',
            'password' => null,
            'port'     => 6379,
            'scheme'   => 'tcp'
        ]
    ],
];

