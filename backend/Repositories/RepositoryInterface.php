<?php

namespace Enersave\Repositories;

/**
 * Repository Interface
 * Interface Segregation Principle: Define contracts that repositories must implement
 */
interface RepositoryInterface
{
    public function findAll(): array;
    public function find(int $id): ?array;
    public function create(array $data): int;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

