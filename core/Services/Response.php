<?php

namespace PCB\Services;

use PCB\App;
use Windwalker\Renderer\BladeRenderer;

class Response
{
    private $view = null;

    public function boot()
    {
        $paths = array(App::getAppRoot(). 'Views/');
        $this->view = new BladeRenderer($paths, array('cache_path' => App::getRoot(). '/cache'));
    }

    public function getView()
    {
        return $this->view;
    }
}