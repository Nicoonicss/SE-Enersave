<?php

require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../classes/DBORM.php';

class ProjectsController
{
    public function index(): void
    {
        $role = $_SESSION['user']['role'] ?? '';
        
        // Load projects from database
        $projectModel = new Project();
        $dbProjects = $projectModel->findAll();
        
        if ($role === 'DONOR_NGO') {
            include __DIR__ . '/../views/donor_projects.php';
        } else if ($role === 'COMMUNITY_USER') {
            include __DIR__ . '/../views/community_projects.php';
        } else {
            include __DIR__ . '/../views/projects.php';
        }
    }

    public function getAll(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $projectModel = new Project();
        $projects = $projectModel->findAll();
        
        // Format projects for frontend
        $formattedProjects = array_map(function($project) {
            $goalAmount = floatval($project['goal_amount'] ?? $project['target_amount'] ?? 0);
            $progress = $goalAmount > 0 
                ? round(($project['raised_amount'] / $goalAmount) * 100, 2) 
                : 0;
            
            return [
                'id' => $project['id'],
                'name' => $project['title'],
                'description' => $project['description'],
                'amount' => $goalAmount,
                'raised' => floatval($project['raised_amount']),
                'progress' => $progress,
                'image' => $project['image_url'] ?? '', // Will be empty if column doesn't exist
                'initiator' => $project['creator_name'] ?? 'Unknown',
                'dateCreated' => date('M d, Y', strtotime($project['created_at'])),
                'category' => 'projects', // Default category
                'status' => $project['status'] ?? 'active'
            ];
        }, $projects);
        
        echo json_encode(['success' => true, 'projects' => $formattedProjects]);
    }

    public function create(): void
    {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        
        $title = trim($data['title'] ?? '');
        $description = trim($data['description'] ?? '');
        $goalAmount = floatval($data['goal_amount'] ?? 0);
        $imageData = $data['image'] ?? ''; // Base64 image data

        if (empty($title) || $goalAmount <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Title and goal amount are required']);
            return;
        }

        // Handle image upload (save base64 to file or store as base64)
        $imageUrl = '';
        if (!empty($imageData)) {
            // Store base64 image data (TEXT field can handle large data)
            // In production, you should save it as a file and store the URL
            $imageUrl = $imageData;
        }

        $projectModel = new Project();
        
        try {
            error_log("Creating project: title=$title, goalAmount=$goalAmount, userId=$userId");
            $projectId = $projectModel->create($userId, $title, $description, $goalAmount, $imageUrl);
            error_log("Project created with ID: $projectId");
            
            echo json_encode([
                'success' => true,
                'id' => $projectId,
                'message' => 'Project created successfully'
            ]);
        } catch (Exception $e) {
            error_log("Error creating project: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create project: ' . $e->getMessage()]);
        }
    }
}

