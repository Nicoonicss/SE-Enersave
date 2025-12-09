<?php

class CommunityController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        if ($role === 'DONOR_NGO') {
            include __DIR__ . '/../views/donor_forum.php';
        } else {
            include __DIR__ . '/../views/community.php';
        }
    }
}


