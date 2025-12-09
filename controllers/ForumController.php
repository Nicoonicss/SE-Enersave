<?php

class ForumController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'SUPPLIER_INSTALLER') {
            include __DIR__ . '/../views/supplier_forum.php';
        } else if ($role === 'EDUCATOR_ADVOCATE') {
            $viewMode = $_SESSION['view_mode'] ?? 'educator';
            if ($viewMode === 'student') {
                include __DIR__ . '/../views/student_forum.php';
            } else {
                include __DIR__ . '/../views/educator_forum.php';
            }
        } else if ($role === 'COMMUNITY_USER') {
            include __DIR__ . '/../views/community_forum.php';
        } else {
            include __DIR__ . '/../views/forum.php';
        }
    }
}

