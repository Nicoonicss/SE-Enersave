<?php

namespace Enersave\Controllers;

use Enersave\Services\ProjectService;

/**
 * Project Controller
 * Single Responsibility: Handle project HTTP requests
 */
class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * List all projects
     */
    public function index(): void
    {
        if ($this->getMethod() !== 'GET') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $projects = $this->projectService->getAll();
            $this->success($projects);
        } catch (\Exception $e) {
            $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Get single project
     */
    public function show(int $id): void
    {
        if ($this->getMethod() !== 'GET') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $project = $this->projectService->getById($id);
            $this->success($project);
        } catch (\Exception $e) {
            $this->error($e->getMessage(), 404);
        }
    }

    /**
     * Create new project
     */
    public function create(): void
    {
        if ($this->getMethod() !== 'POST') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $data = $this->getJsonInput();
            $project = $this->projectService->create($data);
            $this->success($project, 'Project created successfully', 201);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Update project
     */
    public function update(int $id): void
    {
        if ($this->getMethod() !== 'PUT') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $data = $this->getJsonInput();
            $project = $this->projectService->update($id, $data);
            $this->success($project, 'Project updated successfully');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Delete project
     */
    public function delete(int $id): void
    {
        if ($this->getMethod() !== 'DELETE') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $this->projectService->delete($id);
            $this->success([], 'Project deleted successfully');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Get user's projects
     */
    public function userProjects(int $userId): void
    {
        if ($this->getMethod() !== 'GET') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $projects = $this->projectService->getUserProjects($userId);
            $this->success($projects);
        } catch (\Exception $e) {
            $this->error($e->getMessage(), 500);
        }
    }
}

