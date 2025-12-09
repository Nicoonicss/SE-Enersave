<?php

class LearnController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'EDUCATOR_ADVOCATE') {
            $viewMode = $_SESSION['view_mode'] ?? 'educator';
            if ($viewMode === 'student') {
                include __DIR__ . '/../views/student_learn.php';
            } else {
                include __DIR__ . '/../views/educator_learn.php';
            }
        } else if ($role === 'COMMUNITY_USER') {
            include __DIR__ . '/../views/community_learn.php';
        } else {
            include __DIR__ . '/../views/learn.php';
        }
    }
}

