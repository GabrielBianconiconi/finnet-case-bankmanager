<?php

namespace App\Controllers\API;

use App\Models\UserModel;
use \Firebase\JWT\JWT;
use Dotenv\Dotenv;

// Carrega as variáveis de ambiente
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../..');
$dotenv->load();

class AuthController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function login(): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            $secretKey = $_ENV['JWT_SECRET_KEY'] ?? 'sua_chave_secreta_padrao';
            
            $payload = [
                'iat'  => time(), 
                'exp'  => time() + (60 * 60), 
                'data' => [
                    'userId' => $user['id'],
                    'email'  => $user['email']
                ]
            ];

            $jwt = JWT::encode($payload, $secretKey, 'HS256');

            echo json_encode([
                'message' => 'Login bem-sucedido',
                'token' => $jwt
            ]);
            
            http_response_code(200); // OK
            exit();

        } else {

            http_response_code(401); // Unauthorized
            echo json_encode(['error' => 'E-mail ou senha inválidos.']);
            exit();
        }
    }

    public function logout(): void
    {
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Sessão encerrada com sucesso.']);
    }
}