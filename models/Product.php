<?php

class Product
{
    private DBORM $db;

    public function __construct()
    {
        $this->db = new DBORM();
    }

    public function create(int $supplierId, string $name, string $category, float $price, string $description = ''): int
    {
        $this->db->execute(
            'INSERT INTO products (supplier_id, name, category, price, description) VALUES (:supplier_id, :name, :category, :price, :description)',
            [
                ':supplier_id' => $supplierId,
                ':name' => $name,
                ':category' => $category,
                ':price' => $price,
                ':description' => $description,
            ]
        );
        $row = $this->db->query('SELECT LAST_INSERT_ID() AS id');
        return (int)($row[0]['id'] ?? 0);
    }

    public function findAll(?string $category = null): array
    {
        if ($category && strtolower($category) !== 'all') {
            // Use exact match for category (database has: Solar, Wind, Hydro)
            return $this->db->query(
                'SELECT p.*, u.username as supplier_name FROM products p 
                 LEFT JOIN users u ON p.supplier_id = u.id 
                 WHERE p.category = :category 
                 ORDER BY p.created_at DESC',
                [':category' => $category]
            );
        }
        return $this->db->query(
            'SELECT p.*, u.username as supplier_name FROM products p 
             LEFT JOIN users u ON p.supplier_id = u.id 
             ORDER BY p.created_at DESC'
        );
    }

    public function findBySupplier(int $supplierId): array
    {
        return $this->db->query(
            'SELECT * FROM products WHERE supplier_id = :supplier_id ORDER BY created_at DESC',
            [':supplier_id' => $supplierId]
        );
    }

    public function findById(int $id): ?array
    {
        $rows = $this->db->query(
            'SELECT p.*, u.username as supplier_name FROM products p 
             LEFT JOIN users u ON p.supplier_id = u.id 
             WHERE p.id = :id LIMIT 1',
            [':id' => $id]
        );
        return $rows[0] ?? null;
    }

    public function search(string $query): array
    {
        $searchTerm = '%' . $query . '%';
        return $this->db->query(
            'SELECT p.*, u.username as supplier_name FROM products p 
             LEFT JOIN users u ON p.supplier_id = u.id 
             WHERE p.name LIKE :query OR p.description LIKE :query 
             ORDER BY p.created_at DESC',
            [':query' => $searchTerm]
        );
    }
}

