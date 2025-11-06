<?php

namespace Enersave\Services;

use Enersave\Repositories\ProjectRepository;
use Enersave\Repositories\UserRepository;
use Enersave\Validators\ValidatorInterface;

/**
 * Project Service
 * Single Responsibility: Handle project business logic
 */
class ProjectService implements ServiceInterface
{
    private ProjectRepository $projectRepository;
    private UserRepository $userRepository;
    private ?ValidatorInterface $validator;

    public function __construct(
        ProjectRepository $projectRepository,
        UserRepository $userRepository,
        ?ValidatorInterface $validator = null
    ) {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }

    public function getAll(): array
    {
        return $this->projectRepository->findAll();
    }

    public function getById(int $id): array
    {
        $project = $this->projectRepository->find($id);
        if (!$project) {
            throw new \Exception('Project not found');
        }
        return $project;
    }

    public function create(array $data): array
    {
        // Validate data if validator is provided
        if ($this->validator) {
            $this->validator->validate($data);
        }

        // Verify user exists
        $user = $this->userRepository->find($data['user_id']);
        if (!$user) {
            throw new \Exception('User not found');
        }

        $projectId = $this->projectRepository->create($data);
        return $this->projectRepository->find($projectId);
    }

    public function update(int $id, array $data): array
    {
        // Validate data if validator is provided
        if ($this->validator) {
            $this->validator->validate($data);
        }

        $this->projectRepository->update($id, $data);
        return $this->projectRepository->find($id);
    }

    public function delete(int $id): bool
    {
        $project = $this->projectRepository->find($id);
        if (!$project) {
            throw new \Exception('Project not found');
        }
        return $this->projectRepository->delete($id);
    }

    public function getUserProjects(int $userId): array
    {
        return $this->projectRepository->findByUserId($userId);
    }

    public function getProjectsByStatus(string $status): array
    {
        return $this->projectRepository->findByStatus($status);
    }
}

