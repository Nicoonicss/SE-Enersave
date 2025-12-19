<?php

require_once __DIR__ . '/../models/User.php';

class UsersController
{
    public function index(): void
    {
        include __DIR__ . '/../views/users.php';
    }

    public function getAll(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $role = $_GET['role'] ?? null;
        $userModel = new User();
        
        $users = $role && strtolower($role) !== 'all' 
            ? $userModel->findByRole($role) 
            : $userModel->findAll();
        
        // Format users for frontend
        $formattedUsers = array_map(function($user) {
            return [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'status' => $user['status'] ?? 'active',
                'is_verified' => (bool)($user['is_verified'] ?? false),
                'created_at' => $user['created_at'] ?? ''
            ];
        }, $users);
        
        echo json_encode(['success' => true, 'users' => $formattedUsers]);
    }

    public function getCounts(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $userModel = new User();
        $allUsers = $userModel->findAll();
        
        $counts = [
            'total' => count($allUsers),
            'community' => count(array_filter($allUsers, fn($u) => $u['role'] === 'COMMUNITY_USER')),
            'suppliers' => count(array_filter($allUsers, fn($u) => $u['role'] === 'SUPPLIER_INSTALLER')),
            'admins' => count(array_filter($allUsers, fn($u) => $u['role'] === 'ADMIN')),
        ];
        
        echo json_encode(['success' => true, 'counts' => $counts]);
    }
}

