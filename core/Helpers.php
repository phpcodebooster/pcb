<?php

if ( !function_exists('view') )
{
     function view($file, $params=[])
     {
         return \PCB\App::get('response')->getView()->render($file, $params);
     }
}

if ( !function_exists('custom_fatal_error') )
{
    function custom_fatal_error()
    {
        $error = error_get_last();
        if ($error !== NULL && in_array($error['type'], array(E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING))) {
            echo "<pre>";
            print_r($error['message']);
            echo "</pre>";
            die;
        }
    }
}
