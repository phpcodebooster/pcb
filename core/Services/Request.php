<?php

namespace PCB\Services;

use PCB\App;

class Request
{
    private $req_params     = [];
    private $env_params     = [];
    private $server_params  = [];
    private $cookies_params = [];
    private $session_params = [];

    public function boot()
    {
        $this->env_params = $_ENV;
        $this->req_params = $_REQUEST;
        $this->server_params = $_SERVER;
        $this->cookies_params = $_COOKIE;
        $this->session_params = $_SESSION;

        // unset default variables for safety
        unset($_ENV, $_GET, $_POST, $_REQUEST, $_SERVER, $_COOKIE, $_SESSION);
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function env($key, $default=null)
    {
        return array_key_exists($key, $this->env_params) ? $this->env_params[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function request($key, $default=null)
    {
        return array_key_exists($key, $this->req_params) ? $this->req_params[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function server($key, $default=null)
    {
        return array_key_exists($key, $this->server_params) ? $this->server_params[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function session($key, $default=null)
    {
        return array_key_exists($key, $this->session_params) ? $this->session_params[$key] : $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function cookie($key, $default=null)
    {
        return array_key_exists($key, $this->cookies_params) ? $this->cookies_params[$key] : $default;
    }
}