<?php

// Front controller
// Usage: php -S localhost:8000 index.php

// Load Composer autoloader (and any PSR-4 mappings)
require __DIR__ . '/vendor/autoload.php';

// Load core classes
require_once __DIR__ . '/classes/iDBFuncs.php';
require_once __DIR__ . '/classes/DBORM.php';
require_once __DIR__ . '/models/User.php';

// Ensure session started for auth flows
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Delegate to route definitions and dispatcher
require __DIR__ . '/routes/web.php';