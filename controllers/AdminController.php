<?php

class AdminController
{
    public function index(): void
    {
        $pageTitle = 'Admin Dashboard';
        include __DIR__ . '/../views/admin_dashboard.php';
    }
}


