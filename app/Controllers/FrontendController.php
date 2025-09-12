<?php

namespace App\Controllers;

class FrontendController
{
    public function index(): void
    {
        $frontendIndexFile = __DIR__ . '/../../frontend/dist/index.html'; 

        if (file_exists($frontendIndexFile)) {
            readfile($frontendIndexFile);
        } else {
            http_response_code(404);
            echo '<h1>404: Frontend não encontrado.</h1>';
            echo '<p>Por favor, execute o "npm run build" no seu projeto React.</p>';
        }
    }
}