<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController
{

    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

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

        $user = $this->userModel->findByEmail($email);


        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            
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
