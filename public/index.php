<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

// login
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\CourseAreaController;
use App\Controllers\AuthController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Autenticação simples
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$publicRoutes = ['/', '/login']; // Rotas que não precisam de login

if (!$isLoggedIn && !in_array($requestUri, $publicRoutes)) {
    header('Location: /');
    exit;
}

// --- ROTEAMENTO ---
switch ($requestUri) {

    case '/':
        (new AuthController())->showLoginForm();
        break;
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new AuthController())->login();
        } else {
            header('Location: /');
        }
        break;
    case '/logout':
        (new AuthController())->logout();
        break;

    case '/dashboard':
        header('Location: /course-areas');
        exit;
        
    case '/course-areas':
        (new CourseAreaController())->index();
        break;

    default:
        // Página não encontrada
        http_response_code(404);
        echo "<h1>Erro 404: Página não encontrada</h1>";
        break;
}
