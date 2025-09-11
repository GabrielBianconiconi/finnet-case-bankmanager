<?php

namespace App\Controllers;

class AuthController
{
    public function showLoginForm(): void
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /courses');
            exit();
        }
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // teste hardcode
        $adminEmail = '1@gmail.com';
        $adminPassword = '1';

        if ($email === 'admin@bankmanager.com' && $password === 'admin') {
            $_SESSION['user_id'] = 1; 
            session_write_close();
            header('Location: /courses');
            exit();
        } else {
            $_SESSION['error_message'] = 'E-mail ou senha inválidos.';
            header('Location: /login');
            exit();
        }
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
        session_destroy();
        header('Location: /');
        exit;
    }
}
