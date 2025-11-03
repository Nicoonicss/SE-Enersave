<?php

namespace Enersave\Models;

/**
 * Project Model
 * Single Responsibility: Handle project-related database operations
 */
class Project extends Model
{
    protected string $table = 'projects';
    protected string $primaryKey = 'id';
    protected array $fillable = [
        'project_name',
        'community_name',
        'project_description',
        'location',
        'population',
        'energy_type',
        'energy_capacity',
        'budget',
        'timeline',
        'challenges',
        'support_needed',
        'contact_person',
        'contact_email',
        'contact_phone',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];
    protected array $hidden = [];

    /**
     * Find projects by user ID
     */
    public function findByUserId(int $userId): array
    {
        return $this->where('user_id', $userId);
    }

    /**
     * Find projects by status
     */
    public function findByStatus(string $status): array
    {
        return $this->where('status', $status);
    }

    /**
     * Create project
     */
    public function createProject(array $data): int
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['status'] = $data['status'] ?? 'pending';
        
        return $this->create($data);
    }
}

