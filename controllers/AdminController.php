<?php

class AdminController
{
    public function index(): void
    {
        $pageTitle = 'Admin Dashboard';
        include __DIR__ . '/../views/admin_dashboard.php';
    }

    public function users(): void
    {
        $pageTitle = 'Users Management';
        include __DIR__ . '/../views/admin_users.php';
    }

    public function suppliers(): void
    {
        $pageTitle = 'Suppliers Management';
        include __DIR__ . '/../views/admin_suppliers.php';
    }

    public function projects(): void
    {
        $pageTitle = 'Projects Management';
        include __DIR__ . '/../views/admin_projects.php';
    }
}


