<?php

/**
 * CORS Configuration
 * Single Responsibility: Handle Cross-Origin Resource Sharing
 */
class CORSMiddleware
{
    public static function handle(): void
    {
        // Get allowed origins from config
        $allowedOrigins = ['http://localhost:8000', 'http://localhost'];
        
        // Get origin from request
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        
        if (in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        }
        
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');

        // Handle preflight OPTIONS request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }
}

