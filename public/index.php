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
$router->post('/courses/delete/{id}', 'App\\Controllers\\CourseController', 'destroy');

// Rotas de Alunos
$router->get('/students', 'App\\Controllers\\StudentController', 'index');
$router->get('/students/create', 'App\\Controllers\\StudentController', 'create');
$router->post('/students/store', 'App\\Controllers\\StudentController', 'store');
$router->get('/students/edit/{id}', 'App\\Controllers\\StudentController', 'edit');
$router->post('/students/update/{id}', 'App\\Controllers\\StudentController', 'update');

// Rotas de Matrículas
$router->get('/enrollments', 'App\\Controllers\\EnrollmentController', 'index');
$router->get('/enrollments/create', 'App\\Controllers\\EnrollmentController', 'create');
$router->post('/enrollments/store', 'App\\Controllers\\EnrollmentController', 'store');
$router->get('/enrollments/edit/{id}', 'App\\Controllers\\EnrollmentController', 'edit');
$router->post('/enrollments/update/{id}', 'App\\Controllers\\EnrollmentController', 'update');

// Resolve a rota
$router->resolve();