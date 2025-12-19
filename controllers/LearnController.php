<?php

require_once __DIR__ . '/../models/LearningResource.php';

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

    public function getAll(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $resourceModel = new LearningResource();
        
        // Get filter and search parameters
        $category = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;
        $downloadableOnly = isset($_GET['downloadable']) && $_GET['downloadable'] === 'true';
        
        // Map category names (Solar, Wind, Hydro) to database format
        if ($category) {
            $categoryLower = strtolower($category);
            if ($categoryLower === 'solar') {
                $category = 'Solar Energy';
            } else if ($categoryLower === 'wind') {
                $category = 'Wind Energy';
            } else if ($categoryLower === 'hydro') {
                $category = 'Hydro Energy';
            }
        }
        
        // Fetch resources
        if ($search) {
            $resources = $resourceModel->search($search);
            // Apply category filter to search results if needed
            if ($category && strtolower($category) !== 'all') {
                $resources = array_filter($resources, function($resource) use ($category) {
                    $resourceCategory = $resource['category'] ?? '';
                    return stripos($resourceCategory, $category) !== false;
                });
                $resources = array_values($resources);
            }
        } else {
            $resources = $resourceModel->findAll($category, $downloadableOnly);
        }
        
        // Format resources for frontend
        $formattedResources = array_map(function($resource) {
            return [
                'id' => $resource['id'],
                'title' => $resource['title'],
                'description' => $resource['description'] ?? '',
                'category' => $resource['category'] ?? '',
                'file_type' => $resource['file_type'] ?? 'video',
                'file_url' => $resource['file_url'] ?? '',
                'is_downloadable' => (bool)($resource['is_downloadable'] ?? false),
                'educator_name' => $resource['educator_name'] ?? 'Unknown',
                'created_at' => $resource['created_at'] ?? ''
            ];
        }, $resources);
        
        echo json_encode(['success' => true, 'resources' => $formattedResources]);
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
        $fileUrl = trim($data['file_url'] ?? '');
        $fileType = trim($data['file_type'] ?? 'video');
        $category = trim($data['category'] ?? null);
        $isDownloadable = isset($data['is_downloadable']) && $data['is_downloadable'] === true;

        if (empty($title)) {
            http_response_code(400);
            echo json_encode(['error' => 'Title is required']);
            return;
        }

        $resourceModel = new LearningResource();
        
        try {
            $resourceId = $resourceModel->create($userId, $title, $description, $fileUrl, $fileType, $isDownloadable);
            
            echo json_encode([
                'success' => true,
                'id' => $resourceId,
                'message' => 'Learning resource created successfully'
            ]);
        } catch (Exception $e) {
            error_log("Error creating learning resource: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create resource: ' . $e->getMessage()]);
        }
    }
}

