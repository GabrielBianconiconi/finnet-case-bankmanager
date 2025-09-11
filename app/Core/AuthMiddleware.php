<?php

namespace App\Core;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

class AuthMiddleware
{
    public static function checkToken(): void
    {
        header('Content-Type: application/json');

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        
        if (empty($authHeader)) {
            http_response_code(401);
            echo json_encode(['error' => 'Acesso negado. Token não fornecido.']);
            exit();
        }

        $token = str_replace('Bearer ', '', $authHeader);

        $secretKey = $_ENV['JWT_SECRET_KEY'];

        try {

            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido ou expirado.']);
            exit();
        }
    }
}