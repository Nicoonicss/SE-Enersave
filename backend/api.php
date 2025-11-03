<?php

/**
 * API Entry Point
 * Main entry point for all API requests
 */

require __DIR__ . '/bootstrap.php';

use Enersave\Config\Database;
use Enersave\Models\User;
use Enersave\Models\Project;
use Enersave\Repositories\UserRepository;
use Enersave\Repositories\ProjectRepository;
use Enersave\Services\AuthService;
use Enersave\Services\ProjectService;
use Enersave\Validators\RegistrationValidator;
use Enersave\Validators\ProjectValidator;
use Enersave\Controllers\AuthController;
use Enersave\Controllers\ProjectController;
use Enersave\Router\Router;

// Initialize dependencies (Dependency Injection Container)
$bootstrap = require __DIR__ . '/bootstrap.php';

// Models
$userModel = new User();
$projectModel = new Project();

// Repositories
$userRepository = new UserRepository($userModel);
$projectRepository = new ProjectRepository($projectModel);

// Validators
$registrationValidator = new RegistrationValidator();
$projectValidator = new ProjectValidator();

// Services
$authService = new AuthService($userRepository, $registrationValidator);
$projectService = new ProjectService($projectRepository, $userRepository, $projectValidator);

// Controllers
$authController = new AuthController($authService);
$projectController = new ProjectController($projectService);

// Setup Router
$router = new Router();

// Auth routes
$router->post('/api/auth/register', function() use ($authController) {
    $authController->register();
});

$router->post('/api/auth/login', function() use ($authController) {
    $authController->login();
});

// Project routes
$router->get('/api/projects', function() use ($projectController) {
    $projectController->index();
});

$router->get('/api/projects/{id}', function($id) use ($projectController) {
    $projectController->show((int)$id);
});

$router->post('/api/projects', function() use ($projectController) {
    $projectController->create();
});

$router->put('/api/projects/{id}', function($id) use ($projectController) {
    $projectController->update((int)$id);
});

$router->delete('/api/projects/{id}', function($id) use ($projectController) {
    $projectController->delete((int)$id);
});

$router->get('/api/users/{userId}/projects', function($userId) use ($projectController) {
    $projectController->userProjects((int)$userId);
});

// Dispatch request
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

$router->dispatch($requestMethod, $requestUri);

