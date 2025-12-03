<?php

require_once __DIR__ . '/../routes/Router.php';
require_once __DIR__ . '/../helpers/AuthHelper.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/MarketplaceController.php';
require_once __DIR__ . '/../controllers/ProjectsController.php';
require_once __DIR__ . '/../controllers/LearnController.php';
require_once __DIR__ . '/../controllers/ForumController.php';
require_once __DIR__ . '/../controllers/UsersController.php';
require_once __DIR__ . '/../controllers/SuppliersController.php';
require_once __DIR__ . '/../controllers/ReportsController.php';
require_once __DIR__ . '/../controllers/CommunityController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../models/Product.php';

$router = new Router();

// Auth routes
$router->get('/login', function () {
    if (isset($_SESSION['user'])) {
        header('Location: /home');
        exit;
    }
    (new AuthController())->login();
});

$router->get('/register', function () {
    if (isset($_SESSION['user'])) {
        header('Location: /home');
        exit;
    }
    (new AuthController())->register();
});

$router->post('/login', function () {
    (new AuthController())->handleLogin();
});

$router->post('/register', function () {
    (new AuthController())->handleRegister();
});

$router->get('/forgot-password', function () {
    if (isset($_SESSION['user'])) {
        header('Location: /home');
        exit;
    }
    (new AuthController())->forgotPassword();
});

$router->post('/forgot-password', function () {
    (new AuthController())->handleForgotPassword();
});

$router->get('/reset-password', function () {
    if (isset($_SESSION['user'])) {
        header('Location: /home');
        exit;
    }
    (new AuthController())->resetPassword();
});

$router->post('/reset-password', function () {
    (new AuthController())->handleResetPassword();
});

$router->get('/logout', function () {
    (new AuthController())->logout();
});

// Community User routes
$router->get('/home', function () {
    AuthHelper::requireRole(['COMMUNITY_USER', 'EDUCATOR_ADVOCATE', 'DONOR_NGO']);
    (new HomeController())->index();
});

$router->get('/marketplace', function () {
    AuthHelper::requireRole(['COMMUNITY_USER', 'SUPPLIER_INSTALLER', 'DONOR_NGO']);
    (new MarketplaceController())->index();
});

$router->get('/projects', function () {
    AuthHelper::requireRole(['COMMUNITY_USER', 'SUPPLIER_INSTALLER', 'DONOR_NGO', 'ADMIN']);
    (new ProjectsController())->index();
});

$router->get('/learn', function () {
    AuthHelper::requireRole(['COMMUNITY_USER', 'EDUCATOR_ADVOCATE', 'DONOR_NGO']);
    (new LearnController())->index();
});

$router->get('/community', function () {
    AuthHelper::requireRole(['COMMUNITY_USER', 'DONOR_NGO']);
    (new CommunityController())->index();
});

// Supplier/Installer routes
$router->get('/dashboard', function () {
    AuthHelper::requireRole(['SUPPLIER_INSTALLER', 'ADMIN']);
    (new DashboardController())->index();
});

$router->get('/products/create', function () {
    AuthHelper::requireRole(['SUPPLIER_INSTALLER']);
    (new ProductController())->create();
});

$router->post('/products/create', function () {
    AuthHelper::requireRole(['SUPPLIER_INSTALLER']);
    (new ProductController())->handleCreate();
});

$router->get('/products', function () {
    AuthHelper::requireRole(['SUPPLIER_INSTALLER']);
    (new ProductController())->list();
});

$router->get('/forum', function () {
    AuthHelper::requireRole(['SUPPLIER_INSTALLER', 'EDUCATOR_ADVOCATE']);
    (new ForumController())->index();
});

// Admin routes
$router->get('/admin', function () {
    AuthHelper::requireRole(['ADMIN']);
    (new AdminController())->index();
});

$router->get('/dashboard', function () {
    AuthHelper::requireRole(['SUPPLIER_INSTALLER', 'ADMIN']);
    $role = $_SESSION['user']['role'] ?? '';
    if ($role === 'ADMIN') {
        (new AdminController())->index();
    } else {
        (new DashboardController())->index();
    }
});

$router->get('/users', function () {
    AuthHelper::requireRole(['ADMIN']);
    (new UsersController())->index();
});

$router->get('/suppliers', function () {
    AuthHelper::requireRole(['ADMIN']);
    (new SuppliersController())->index();
});

$router->get('/reports', function () {
    AuthHelper::requireRole(['ADMIN']);
    (new ReportsController())->index();
});

// Legacy routes (for backward compatibility)
$router->get('/explore', function () {
    AuthHelper::requireAuth();
    $role = $_SESSION['user']['role'] ?? 'COMMUNITY_USER';
    if ($role === 'COMMUNITY_USER') {
        header('Location: /home');
    } else {
        header('Location: /dashboard');
    }
    exit;
});

$router->get('/project_support', function () {
    AuthHelper::requireAuth();
    header('Location: /projects');
    exit;
});

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($path === '/' || $path === '') {
    if (isset($_SESSION['user'])) {
        $role = $_SESSION['user']['role'] ?? 'COMMUNITY_USER';
        $redirectUrl = match($role) {
            'COMMUNITY_USER', 'EDUCATOR_ADVOCATE', 'DONOR_NGO' => '/home',
            'SUPPLIER_INSTALLER', 'ADMIN' => '/dashboard',
            default => '/home',
        };
        header('Location: ' . $redirectUrl);
    } else {
        header('Location: /login');
    }
    exit;
}

$router->dispatch($method, $path);
