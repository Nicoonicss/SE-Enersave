<?php

class ProjectsController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'DONOR_NGO') {
            include __DIR__ . '/../views/donor_projects.php';
        } else if ($role === 'COMMUNITY_USER') {
            include __DIR__ . '/../views/community_projects.php';
        } else {
            include __DIR__ . '/../views/projects.php';
        }
    }
}

