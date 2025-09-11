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
        // Define o cabeçalho para a resposta JSON
        header('Content-Type: application/json');

        // Lê o corpo da requisição JSON em vez de $_POST
        $data = json_decode(file_get_contents('php://input'), true);

        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        // Tenta encontrar o usuário pelo email
        $user = $this->userModel->findByEmail($email);

        // Verifica as credenciais
        if ($user && password_verify($password, $user['password'])) {
            // Se as credenciais estiverem corretas, gera um JWT
            $secretKey = $_ENV['JWT_SECRET_KEY'] ?? 'sua_chave_secreta_padrao';
            
            // Payload (dados do token)
            $payload = [
                'iat'  => time(), // Tempo em que o token foi emitido
                'exp'  => time() + (60 * 60), // Expira em 1 hora
                'data' => [
                    'userId' => $user['id'],
                    'email'  => $user['email']
                ]
            ];

            $jwt = JWT::encode($payload, $secretKey, 'HS256');

            // Retorna o token em uma resposta JSON
            echo json_encode([
                'message' => 'Login bem-sucedido',
                'token' => $jwt
            ]);
            
            http_response_code(200); // OK
            exit();

        } else {
            // Se as credenciais estiverem incorretas, retorna um erro 401
            http_response_code(401); // Unauthorized
            echo json_encode(['error' => 'E-mail ou senha inválidos.']);
            exit();
        }
    }

    public function logout(): void
    {
        // Para logout em uma API com JWT, não é necessário lógica no servidor.
        // O cliente simplesmente descarta o token.
        // Você pode retornar uma mensagem de sucesso para confirmação.
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Sessão encerrada com sucesso.']);
    }
}