<?php

/**
 * Simple PHP Built-in Server Wrapper
 * Handles routing for PHP's built-in web server
 */

// Set the document root
$documentRoot = __DIR__;

// Get the request URI
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

// If request is for a static file, serve it
$filePath = $documentRoot . $requestUri;
if (file_exists($filePath) && is_file($filePath)) {
    return false; // Let PHP's built-in server handle it
}

// Otherwise, route to api.php
$_SERVER['SCRIPT_NAME'] = '/api.php';
require $documentRoot . '/api.php';

