<?php

class DashboardController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'SUPPLIER_INSTALLER') {
            include __DIR__ . '/../views/supplier_dashboard.php';
        } else {
            include __DIR__ . '/../views/dashboard.php';
        }
    }
}

