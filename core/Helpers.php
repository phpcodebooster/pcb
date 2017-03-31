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
        if(!empty($error)) {
            var_dump($error);
            exit;
        }
    }
}
