<?php

namespace PCB\Services;

use PCB\App;

class Router
{
    use Singleton;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $response = null;

        try {

            // get request object
            $request = App::get('request');

            // get the router components
            $default_options = [\App\Controllers\Home::class, 'index'];
            $router_components = explode('/', $request->request('params'));

            // merge the controller
            $controller_function = !empty($router_components[1]) ? strtolower($router_components[1]) : $default_options[1];
            $controller = !empty($router_components[0]) ? "\\App\\Controllers\\" .ucfirst($router_components[0]) : $default_options[0];

            if ( class_exists($controller) )
            {
                 // create controller object
                 $controller_obj = new $controller;

                 if( method_exists($controller_obj, $controller_function) )
                 {
                     // call the target controller and get the response
                     $response = $controller_obj->$controller_function();
                 }
                 else {
                     throw new \Exception("Method: <b>{$controller_function}</b> does not exist in <b>{$controller}</b>.");
                 }
            }
            else {
                throw new \Exception("Controller: <b>{$controller}</b> does not exist.");
            }
        }
        catch (\Exception $e) {
            exit($e->getMessage());
        }

        echo $response;
    }
}