<?php

namespace Enersave\Models;

use Enersave\Config\Database;
use PDO;

/**
 * Base Model Class
 * Single Responsibility: Define common database operations for all models
 */
abstract class Model
{
    protected PDO $db;
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $fillable = [];
    protected array $hidden = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Find a record by ID
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ? $this->hideAttributes($result) : null;
    }

    /**
     * Find all records
     */
    public function findAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} DESC");
        $stmt->execute();
        $results = $stmt->fetchAll();
        return array_map([$this, 'hideAttributes'], $results);
    }

    /**
     * Find records by conditions
     */
    public function where(string $column, $value): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = :value");
        $stmt->execute(['value' => $value]);
        $results = $stmt->fetchAll();
        return array_map([$this, 'hideAttributes'], $results);
    }

    /**
     * Find single record by condition
     */
    public function findOneBy(string $column, $value): ?array
    {
        $results = $this->where($column, $value);
        return !empty($results) ? $results[0] : null;
    }

    /**
     * Create a new record
     */
    public function create(array $data): int
    {
        $filteredData = $this->filterFillable($data);
        $columns = implode(', ', array_keys($filteredData));
        $placeholders = ':' . implode(', :', array_keys($filteredData));

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        $stmt->execute($filteredData);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Update a record by ID
     */
    public function update(int $id, array $data): bool
    {
        $filteredData = $this->filterFillable($data);
        $setClause = implode(', ', array_map(fn($key) => "{$key} = :{$key}", array_keys($filteredData)));

        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = :id");
        $filteredData['id'] = $id;

        return $stmt->execute($filteredData);
    }

    /**
     * Delete a record by ID
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Filter data to only include fillable fields
     */
    protected function filterFillable(array $data): array
    {
        if (empty($this->fillable)) {
            return $data;
        }

        return array_intersect_key($data, array_flip($this->fillable));
    }

    /**
     * Hide sensitive attributes
     */
    protected function hideAttributes(array $data): array
    {
        if (empty($this->hidden)) {
            return $data;
        }

        foreach ($this->hidden as $attribute) {
            unset($data[$attribute]);
        }

        return $data;
    }
}

