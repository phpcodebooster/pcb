<?php
/**
 * Created by PhpStorm.
 * User: spatel
 * Date: 2017-03-29
 * Time: 4:03 PM
 */

namespace App\Controllers;

use PCB\App;

class Home
{
    public function index()
    {
        $read_connection = App::get('database')->getRedisConnection();

        return view('index', ['message' => 'Welcome to my site']);
    }
}