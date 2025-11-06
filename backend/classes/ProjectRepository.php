<?php

namespace Enersave\Repositories;

use Enersave\Models\Project;

/**
 * Project Repository
 * Dependency Inversion Principle: Depend on abstractions (Model) not concretions
 */
class ProjectRepository implements RepositoryInterface
{
    private Project $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function findAll(): array
    {
        return $this->model->findAll();
    }

    public function find(int $id): ?array
    {
        return $this->model->find($id);
    }

    public function create(array $data): int
    {
        return $this->model->createProject($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    public function findByUserId(int $userId): array
    {
        return $this->model->findByUserId($userId);
    }

    public function findByStatus(string $status): array
    {
        return $this->model->findByStatus($status);
    }
}

