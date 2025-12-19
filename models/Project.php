<?php

require_once __DIR__ . '/../classes/DBORM.php';

class Project
{
    private DBORM $db;

    public function __construct()
    {
        $this->db = new DBORM();
    }

    public function create(int $createdBy, string $title, string $description, float $goalAmount, string $imageUrl = ''): int
    {
        // Use actual column names: user_id, target_amount (not created_by, goal_amount)
        // Note: image_url column doesn't exist yet, so we'll skip it for now
        $this->db->execute(
            'INSERT INTO projects (title, description, target_amount, raised_amount, user_id) 
             VALUES (:title, :description, :target_amount, 0, :user_id)',
            [
                ':title' => $title,
                ':description' => $description,
                ':target_amount' => $goalAmount,
                ':user_id' => $createdBy,
            ]
        );
        $row = $this->db->query('SELECT LAST_INSERT_ID() AS id');
        return (int)($row[0]['id'] ?? 0);
    }

    public function findAll(): array
    {
        // Use actual column name: user_id (not created_by)
        return $this->db->query(
            'SELECT p.*, u.username as creator_name,
                    p.target_amount as goal_amount,
                    p.user_id as created_by
             FROM projects p 
             LEFT JOIN users u ON p.user_id = u.id 
             ORDER BY p.created_at DESC'
        );
    }

    public function findById(int $id): ?array
    {
        // Use actual column name: user_id (not created_by)
        $rows = $this->db->query(
            'SELECT p.*, u.username as creator_name,
                    p.target_amount as goal_amount,
                    p.user_id as created_by
             FROM projects p 
             LEFT JOIN users u ON p.user_id = u.id 
             WHERE p.id = :id LIMIT 1',
            [':id' => $id]
        );
        return $rows[0] ?? null;
    }

    public function findByCreator(int $userId): array
    {
        // Use actual column name: user_id (not created_by)
        return $this->db->query(
            'SELECT *, target_amount as goal_amount, user_id as created_by 
             FROM projects WHERE user_id = :user_id ORDER BY created_at DESC',
            [':user_id' => $userId]
        );
    }

    public function updateRaisedAmount(int $id, float $amount): void
    {
        $this->db->execute(
            'UPDATE projects SET raised_amount = :amount WHERE id = :id',
            [
                ':amount' => $amount,
                ':id' => $id,
            ]
        );
    }
}

