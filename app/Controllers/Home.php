<?php
/**
 * Created by PhpStorm.
 * User: spatel
 * Date: 2017-03-29
 * Time: 4:03 PM
 */

namespace App\Controllers;

class Home
{
    public function index()
    {
        return view('index');
    }
}