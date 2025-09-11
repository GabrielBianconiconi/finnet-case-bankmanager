<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    /**
     * Retorna uma instância única da conexão PDO (Padrão Singleton).
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $host = $_ENV['DB_HOST'] ?? 'db';
            $dbName = $_ENV['DB_NAME'] ?? 'bankmanager';
            $user = $_ENV['DB_USER'] ?? 'user';
            $pass = $_ENV['DB_PASS'] ?? 'password';

            $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";

            try {
                self::$instance = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                error_log('Erro de conexão com o banco de dados: ' . $e->getMessage());
                die('Erro de conexão com o banco. Verifique os logs.');
            }
        }

        return self::$instance;
    }

    private function __construct() {}

    private function __clone() {}
}