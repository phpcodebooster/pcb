<?php

if ( !function_exists('view') )
{
     function view($file, $params=[])
     {
         return \PCB\App::get('response')->getView()->render($file, $params);
     }
}