<?php

class AuthHelper
{
    public static function requireAuth(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }
    
    public static function requireRole(array $allowedRoles): void
    {
        self::requireAuth();
        $userRole = $_SESSION['user']['role'] ?? '';
        if (!in_array($userRole, $allowedRoles)) {
            http_response_code(403);
            die('Access denied. You do not have permission to access this page.');
        }
    }
    
    public static function canAccess(string $path): bool
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }
        
        $role = $_SESSION['user']['role'] ?? '';
        $roleAccess = [
            'COMMUNITY_USER' => ['/home', '/marketplace', '/projects', '/learn', '/community'],
            'SUPPLIER_INSTALLER' => ['/dashboard', '/marketplace', '/projects', '/forum'],
            'EDUCATOR_ADVOCATE' => ['/home', '/learn', '/forum'],
            'DONOR_NGO' => ['/home', '/projects', '/community'],
            'ADMIN' => ['/dashboard', '/users', '/suppliers', '/projects', '/reports'],
        ];
        
        $allowedPaths = $roleAccess[$role] ?? [];
        return in_array($path, $allowedPaths);
    }
}

