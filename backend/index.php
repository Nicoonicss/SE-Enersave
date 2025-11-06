<?php
/**
 * Enersave Backend API - Main Router
 * 
 * To start the server:
 *   cd backend
 *   php -S localhost:8000 index.php
 * 
 * Then access:
 *   - Home page: http://localhost:8000/
 *   - API info: http://localhost:8000/api
 *   - API endpoints: http://localhost:8000/api/auth/register, etc.
 */

// Enable CORS for development
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Get the request URI and parse it
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove leading slash and split the path
$path = trim($requestUri, '/');
$segments = explode('/', $path);

// Route handling
if ($path === '' || $path === 'index.php' || $path === 'index.php/') {
    // Home page - show API documentation
    header('Content-Type: text/html; charset=UTF-8');
    include __DIR__ . '/views/home.php';
} elseif ($path === 'api' || $path === 'api/') {
    // API entry point info
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Enersave API is running',
        'version' => '1.0.0',
        'endpoints' => [
            'auth' => '/api/auth',
            'projects' => '/api/projects'
        ]
    ]);
} elseif (strpos($path, 'api/') === 0 || strpos($requestUri, '/api/') !== false) {
    // API routes - include the existing API router
    // Let api.php handle the routing
    require_once __DIR__ . '/bootstrap.php';
    require_once __DIR__ . '/api.php';
} else {
    // 404 - Page not found
    http_response_code(404);
    header('Content-Type: text/html; charset=UTF-8');
    include __DIR__ . '/views/404.php';
}
