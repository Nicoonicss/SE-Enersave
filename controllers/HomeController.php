<?php

class HomeController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'DONOR_NGO') {
            include __DIR__ . '/../views/donor_home.php';
        } else if ($role === 'EDUCATOR_ADVOCATE') {
            $viewMode = $_SESSION['view_mode'] ?? 'educator';
            if ($viewMode === 'student') {
                include __DIR__ . '/../views/student_home.php';
            } else {
                include __DIR__ . '/../views/educator_home.php';
            }
        } else if ($role === 'COMMUNITY_USER') {
            include __DIR__ . '/../views/community_user_home.php';
        } else {
            include __DIR__ . '/../views/home.php';
        }
    }
}

