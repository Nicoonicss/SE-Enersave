<?php

require_once __DIR__ . '/../classes/DBORM.php';

class ForumPost
{
    private DBORM $db;

    public function __construct()
    {
        $this->db = new DBORM();
    }

    public function create(int $authorId, string $title, string $content, ?string $category = null): int
    {
        $this->db->execute(
            'INSERT INTO forum_posts (author_id, title, content, category) 
             VALUES (:author_id, :title, :content, :category)',
            [
                ':author_id' => $authorId,
                ':title' => $title,
                ':content' => $content,
                ':category' => $category,
            ]
        );
        $row = $this->db->query('SELECT LAST_INSERT_ID() AS id');
        return (int)($row[0]['id'] ?? 0);
    }

    public function findAll(?string $category = null): array
    {
        if ($category && strtolower($category) !== 'all') {
            return $this->db->query(
                'SELECT p.*, u.username as author_name,
                        (SELECT COUNT(*) FROM forum_replies WHERE post_id = p.id) as reply_count
                 FROM forum_posts p 
                 LEFT JOIN users u ON p.author_id = u.id 
                 WHERE p.category = :category 
                 ORDER BY p.created_at DESC',
                [':category' => $category]
            );
        }
        return $this->db->query(
            'SELECT p.*, u.username as author_name,
                    (SELECT COUNT(*) FROM forum_replies WHERE post_id = p.id) as reply_count
             FROM forum_posts p 
             LEFT JOIN users u ON p.author_id = u.id 
             ORDER BY p.created_at DESC'
        );
    }

    public function findById(int $id): ?array
    {
        $rows = $this->db->query(
            'SELECT p.*, u.username as author_name,
                    (SELECT COUNT(*) FROM forum_replies WHERE post_id = p.id) as reply_count
             FROM forum_posts p 
             LEFT JOIN users u ON p.author_id = u.id 
             WHERE p.id = :id LIMIT 1',
            [':id' => $id]
        );
        return $rows[0] ?? null;
    }

    public function search(string $query): array
    {
        $searchTerm = '%' . $query . '%';
        return $this->db->query(
            'SELECT p.*, u.username as author_name,
                    (SELECT COUNT(*) FROM forum_replies WHERE post_id = p.id) as reply_count
             FROM forum_posts p 
             LEFT JOIN users u ON p.author_id = u.id 
             WHERE p.title LIKE :query OR p.content LIKE :query 
             ORDER BY p.created_at DESC',
            [':query' => $searchTerm]
        );
    }

    public function incrementViews(int $id): void
    {
        $this->db->execute(
            'UPDATE forum_posts SET views = views + 1 WHERE id = :id',
            [':id' => $id]
        );
    }
}

