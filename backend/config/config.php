<?php

return [
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'enersave_db',
        'username' => 'root',
        'password' => '',
    ],
    'app' => [
        'name' => 'SE-Enersave',
        'url' => 'http://localhost:8000',
        'env' => 'development',
    ],
    'security' => [
        'jwt_secret' => 'your-secret-key-change-in-production',
        'password_cost' => 12,
    ],
    'cors' => [
        'allowed_origins' => ['http://localhost:8000'],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        'allowed_headers' => ['Content-Type', 'Authorization'],
    ],
];

