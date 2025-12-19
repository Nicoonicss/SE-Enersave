<?php

require_once __DIR__ . '/../models/ForumPost.php';
require_once __DIR__ . '/../models/ForumReply.php';

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

    public function getAllPosts(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $postModel = new ForumPost();
        
        // Get filter and search parameters
        $category = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;
        
        // Fetch posts
        if ($search) {
            $posts = $postModel->search($search);
            // Apply category filter to search results if needed
            if ($category && strtolower($category) !== 'all') {
                $posts = array_filter($posts, function($post) use ($category) {
                    $postCategory = $post['category'] ?? '';
                    return strcasecmp($postCategory, $category) === 0;
                });
                $posts = array_values($posts);
            }
        } else {
            $posts = $postModel->findAll($category);
        }
        
        // Format posts for frontend
        $formattedPosts = array_map(function($post) {
            return [
                'id' => $post['id'],
                'title' => $post['title'],
                'content' => $post['content'],
                'category' => $post['category'] ?? '',
                'author_name' => $post['author_name'] ?? 'Unknown',
                'reply_count' => (int)($post['reply_count'] ?? 0),
                'views' => (int)($post['views'] ?? 0),
                'created_at' => $post['created_at'] ?? ''
            ];
        }, $posts);
        
        echo json_encode(['success' => true, 'posts' => $formattedPosts]);
    }

    public function createPost(): void
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
        $content = trim($data['content'] ?? '');
        $category = trim($data['category'] ?? null);

        if (empty($title)) {
            http_response_code(400);
            echo json_encode(['error' => 'Title is required']);
            return;
        }

        $postModel = new ForumPost();
        
        try {
            $postId = $postModel->create($userId, $title, $content, $category ?: null);
            
            echo json_encode([
                'success' => true,
                'id' => $postId,
                'message' => 'Post created successfully'
            ]);
        } catch (Exception $e) {
            error_log("Error creating forum post: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create post: ' . $e->getMessage()]);
        }
    }

    public function getReplies(): void
    {
        header('Content-Type: application/json');
        AuthHelper::requireAuth();
        
        $postId = $_GET['post_id'] ?? null;
        if (!$postId) {
            http_response_code(400);
            echo json_encode(['error' => 'post_id is required']);
            return;
        }

        $replyModel = new ForumReply();
        $replies = $replyModel->findByPostId((int)$postId);
        
        // Format replies for frontend
        $formattedReplies = array_map(function($reply) {
            return [
                'id' => $reply['id'],
                'content' => $reply['content'],
                'author_name' => $reply['author_name'] ?? 'Unknown',
                'created_at' => $reply['created_at'] ?? ''
            ];
        }, $replies);
        
        echo json_encode(['success' => true, 'replies' => $formattedReplies]);
    }

    public function createReply(): void
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
        
        $postId = (int)($data['post_id'] ?? 0);
        $content = trim($data['content'] ?? '');

        if ($postId <= 0 || empty($content)) {
            http_response_code(400);
            echo json_encode(['error' => 'Post ID and content are required']);
            return;
        }

        $replyModel = new ForumReply();
        
        try {
            $replyId = $replyModel->create($postId, $userId, $content);
            
            // Get updated reply count
            $replyCount = $replyModel->getReplyCount($postId);
            
            echo json_encode([
                'success' => true,
                'id' => $replyId,
                'reply_count' => $replyCount,
                'message' => 'Reply created successfully'
            ]);
        } catch (Exception $e) {
            error_log("Error creating forum reply: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create reply: ' . $e->getMessage()]);
        }
    }
}

