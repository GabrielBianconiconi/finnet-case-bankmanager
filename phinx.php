<?php
require_once __DIR__ . '/vendor/autoload.php';

return
[
    'paths' => [
        'migrations' => '/var/www/html/database/migrations',
        'seeds' => '/var/www/html/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => 'db',
            'name' => 'bankmanager',
            'user' => 'user',
            'pass' => 'password',
            'port' => '3306',
            'charset' => 'utf8mb4',
        ],
    ],
    'version_order' => 'creation'
];
