<?php

require_once __DIR__ . '/../classes/DBORM.php';

class ForumReply
{
    private DBORM $db;

    public function __construct()
    {
        $this->db = new DBORM();
    }

    public function create(int $postId, int $authorId, string $content): int
    {
        $this->db->execute(
            'INSERT INTO forum_replies (post_id, author_id, content) 
             VALUES (:post_id, :author_id, :content)',
            [
                ':post_id' => $postId,
                ':author_id' => $authorId,
                ':content' => $content,
            ]
        );
        $row = $this->db->query('SELECT LAST_INSERT_ID() AS id');
        return (int)($row[0]['id'] ?? 0);
    }

    public function findByPostId(int $postId): array
    {
        return $this->db->query(
            'SELECT r.*, u.username as author_name
             FROM forum_replies r 
             LEFT JOIN users u ON r.author_id = u.id 
             WHERE r.post_id = :post_id 
             ORDER BY r.created_at ASC',
            [':post_id' => $postId]
        );
    }

    public function findById(int $id): ?array
    {
        $rows = $this->db->query(
            'SELECT r.*, u.username as author_name
             FROM forum_replies r 
             LEFT JOIN users u ON r.author_id = u.id 
             WHERE r.id = :id LIMIT 1',
            [':id' => $id]
        );
        return $rows[0] ?? null;
    }

    public function getReplyCount(int $postId): int
    {
        $result = $this->db->query(
            'SELECT COUNT(*) as count FROM forum_replies WHERE post_id = :post_id',
            [':post_id' => $postId]
        );
        return (int)($result[0]['count'] ?? 0);
    }
}

