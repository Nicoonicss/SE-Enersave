<?php

require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../controllers/ExploreController.php';
require_once __DIR__ . '/../controllers/CommunityController.php';
require_once __DIR__ . '/../controllers/ProjectSupportController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/AuthController.php';

$router = new Router();

$router->get('/explore', function () {
    if (!isset($_SESSION['user'])) { header('Location: /login'); exit; }
    (new ExploreController())->index();
});

$router->get('/community', function () {
    if (!isset($_SESSION['user'])) { header('Location: /login'); exit; }
    (new CommunityController())->index();
});

$router->get('/project_support', function () {
    if (!isset($_SESSION['user'])) { header('Location: /login'); exit; }
    (new ProjectSupportController())->index();
});

$router->get('/admin', function () {
    if (!isset($_SESSION['user'])) { header('Location: /login'); exit; }
    (new AdminController())->index();
});

$router->get('/login', function () {
    (new AuthController())->login();
});

$router->get('/register', function () {
    (new AuthController())->register();
});

$router->post('/login', function () {
    (new AuthController())->handleLogin();
});

$router->post('/register', function () {
    (new AuthController())->handleRegister();
});

$router->get('/logout', function () {
    (new AuthController())->logout();
});

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($path === '/' || $path === '') {
    header('Location: /explore');
    exit;
}

$router->dispatch($method, $path);


