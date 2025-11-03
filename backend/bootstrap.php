<?php

/**
 * Bootstrap file
 * Handles dependency injection and setup
 */
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load configuration
$config = require __DIR__ . '/config/config.php';

// Initialize database
use Enersave\Config\Database;
Database::init($config['database']);

// Load classes
spl_autoload_register(function ($class) {
    $prefix = 'Enersave\\';
    $baseDir = __DIR__ . '/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Handle CORS
require __DIR__ . '/CORS.php';
CORSMiddleware::handle();

return [
    'config' => $config,
];

