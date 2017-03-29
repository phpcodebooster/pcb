<?php

namespace App;

class Bootstrap
{
    /**
     * Service name should be unique
     * and must be lowercase key with
     * class name with ::class
     *
     * @var array
     */
    public static $services = [
        'cache' => Services\CacheService::class
    ];
}