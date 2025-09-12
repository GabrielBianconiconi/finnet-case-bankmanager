<?php

// Headers CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Router;
use App\Controllers\FrontendController;

use App\Controllers\API\CourseController as CourseAPIController;
use App\Controllers\API\StudentController as StudentAPIController;
use App\Controllers\API\EnrollmentController as EnrollmentAPIController;
use App\Controllers\API\AuthController as AuthAPIController;
use App\Controllers\API\CourseAreaController as CourseAreaAPIController;

$router = new Router();

$router->post('/api/login', AuthAPIController::class, 'login');

// Rotas da API para Cursos
$router->get('/api/courses', CourseAPIController::class, 'index');
$router->get('/api/courses/{id}', CourseAPIController::class, 'show');
$router->post('/api/courses', CourseAPIController::class, 'store');
$router->put('/api/courses/{id}', CourseAPIController::class, 'update');
$router->delete('/api/courses/{id}', CourseAPIController::class, 'destroy');

// Rotas da API para Alunos
$router->get('/api/students', StudentAPIController::class, 'index');
$router->get('/api/students/{id}', StudentAPIController::class, 'show');
$router->post('/api/students', StudentAPIController::class, 'store');
$router->put('/api/students/{id}', StudentAPIController::class, 'update');
$router->delete('/api/students/{id}', StudentAPIController::class, 'destroy');

// Rotas da API para Matrículas
$router->get('/api/enrollments', EnrollmentAPIController::class, 'index');
$router->get('/api/enrollments/{id}', EnrollmentAPIController::class, 'show');
$router->post('/api/enrollments', EnrollmentAPIController::class, 'store');
$router->put('/api/enrollments/{id}', EnrollmentAPIController::class, 'update');
$router->delete('/api/enrollments/{id}', EnrollmentAPIController::class, 'destroy');

$router->get('/{path}', FrontendController::class, 'index');
$router->get('/', FrontendController::class, 'index');

$router->resolve();