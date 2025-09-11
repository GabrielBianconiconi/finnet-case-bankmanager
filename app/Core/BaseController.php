<?php

namespace App\Core;

abstract class BaseController
{
    
    protected function render(string $viewPath, array $data = []): void
    {
        extract($data);
        ob_start();
        
        require_once __DIR__ . "/../Views/{$viewPath}.php";

        $content = ob_get_clean();

        require_once __DIR__ . '/../Views/layout.php';

    }
}
