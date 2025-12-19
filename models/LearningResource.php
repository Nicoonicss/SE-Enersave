<?php

class LearningResource
{
    private DBORM $db;

    public function __construct()
    {
        $this->db = new DBORM();
    }

    public function create(int $educatorId, string $title, string $description, string $fileUrl, string $fileType, bool $isDownloadable): int
    {
        $this->db->execute(
            'INSERT INTO learning_resources (educator_id, title, description, file_url, file_type, is_downloadable) VALUES (:educator_id, :title, :description, :file_url, :file_type, :is_downloadable)',
            [
                ':educator_id' => $educatorId,
                ':title' => $title,
                ':description' => $description,
                ':file_url' => $fileUrl,
                ':file_type' => $fileType,
                ':is_downloadable' => $isDownloadable ? 1 : 0,
            ]
        );
        $row = $this->db->query('SELECT LAST_INSERT_ID() AS id');
        return (int)($row[0]['id'] ?? 0);
    }

    public function findAll(?string $category = null, bool $downloadableOnly = false): array
    {
        $whereConditions = [];
        $params = [];
        
        if ($downloadableOnly) {
            $whereConditions[] = 'lr.is_downloadable = 1';
        } else {
            $whereConditions[] = 'lr.is_downloadable = 0';
        }
        
        if ($category && strtolower($category) !== 'all') {
            $whereConditions[] = 'lr.category = :category';
            $params[':category'] = $category;
        }
        
        $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
        
        return $this->db->query(
            "SELECT lr.*, u.username as educator_name FROM learning_resources lr 
             LEFT JOIN users u ON lr.educator_id = u.id 
             {$whereClause}
             ORDER BY lr.created_at DESC",
            $params
        );
    }

    public function search(string $query): array
    {
        $searchTerm = '%' . $query . '%';
        return $this->db->query(
            'SELECT lr.*, u.username as educator_name FROM learning_resources lr 
             LEFT JOIN users u ON lr.educator_id = u.id 
             WHERE lr.title LIKE :query OR lr.description LIKE :query 
             ORDER BY lr.created_at DESC',
            [':query' => $searchTerm]
        );
    }

    public function findByEducator(int $educatorId): array
    {
        return $this->db->query(
            'SELECT * FROM learning_resources WHERE educator_id = :educator_id ORDER BY created_at DESC',
            [':educator_id' => $educatorId]
        );
    }

    public function findById(int $id): ?array
    {
        $result = $this->db->query(
            'SELECT lr.*, u.username as educator_name FROM learning_resources lr 
             LEFT JOIN users u ON lr.educator_id = u.id 
             WHERE lr.id = :id',
            [':id' => $id]
        );
        return $result[0] ?? null;
    }
}

