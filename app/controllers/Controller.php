<?php

namespace app\controllers;

use League\Plates\Engine;

abstract class Controller
{
    protected function view(string $view, array $data = [])
    {
        $viewPath = '../app/views/'.$view.'.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("A view {$view} não existe");
        }

        // Create new Plates instance
        $templates = new Engine('../app/views');

        // Render a template
        echo $templates->render($view, $data);
    }
}
