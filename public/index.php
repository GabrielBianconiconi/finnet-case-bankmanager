<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\CourseAreaController;
use App\Controllers\AuthController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$isLoggedIn = isset($_SESSION['user_id']);
$publicRoutes = ['/', '/login'];

if (!$isLoggedIn && !in_array($requestUri, $publicRoutes)) {
    header('Location: /login');
    exit;
}

if ($isLoggedIn && in_array($requestUri, $publicRoutes)) {
    header('Location: /courses');
    exit;
}
// --- ROTEAMENTO ---
$router = new Router();

// Rotas de Autenticação
$router->get('/', 'App\\Controllers\\AuthController', 'showLoginForm');
$router->get('/login', 'App\\Controllers\\AuthController', 'showLoginForm');
$router->post('/login', 'App\\Controllers\\AuthController', 'login');
$router->get('/logout', 'App\\Controllers\\AuthController', 'logout');

// Rotas de Cursos (CRUD)
$router->get('/courses', 'App\\Controllers\\CourseController', 'index');
$router->get('/courses/create', 'App\\Controllers\\CourseController', 'create');
$router->post('/courses/store', 'App\\Controllers\\CourseController', 'store');
$router->get('/courses/edit/{id}', 'App\\Controllers\\CourseController', 'edit');
$router->post('/courses/update/{id}', 'App\\Controllers\\CourseController', 'update');

// Resolve a rota
$router->resolve();