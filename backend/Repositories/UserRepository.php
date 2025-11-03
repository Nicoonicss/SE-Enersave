<?php

namespace Enersave\Repositories;

use Enersave\Models\User;

/**
 * User Repository
 * Dependency Inversion Principle: Depend on abstractions (Model) not concretions
 */
class UserRepository implements RepositoryInterface
{
    private User $model;

    public function __construct(User $model)
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
        return $this->model->createUser($data);
    }

    public function update(int $id, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = $this->model->hashPassword($data['password']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->model->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    public function findByEmail(string $email): ?array
    {
        return $this->model->findByEmail($email);
    }

    public function findByUsername(string $username): ?array
    {
        return $this->model->findByUsername($username);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return $this->model->verifyPassword($password, $hash);
    }

    public function findWithPassword(int $id): ?array
    {
        return $this->model->findWithPassword($id);
    }
}

