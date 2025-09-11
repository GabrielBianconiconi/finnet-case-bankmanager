<?php

namespace App\Controllers;

class AuthController
{
    public function showLoginForm(): void
    {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // teste hardcode
        $adminEmail = 'jubilut@bankmanager.com';
        $adminPassword = 'jubilut123';

        if ($email === $adminEmail && $password === $adminPassword) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_email'] = $email;
            
            header('Location: /dashboard');
            exit;
        } else {
            $error = 'Email ou senha inválidos.';
            
            require_once __DIR__ . '/../Views/auth/login.php';
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
