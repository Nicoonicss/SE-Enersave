<?php

namespace Enersave\Controllers;

use Enersave\Services\AuthService;

/**
 * Auth Controller
 * Single Responsibility: Handle authentication HTTP requests
 */
class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle user registration
     */
    public function register(): void
    {
        if ($this->getMethod() !== 'POST') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $data = $this->getJsonInput();
            $user = $this->authService->register($data);
            $this->success($user, 'User registered successfully', 201);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Handle user login
     */
    public function login(): void
    {
        if ($this->getMethod() !== 'POST') {
            $this->error('Method not allowed', 405);
            return;
        }

        try {
            $data = $this->getJsonInput();
            
            if (empty($data['email']) || empty($data['password'])) {
                $this->error('Email and password are required');
                return;
            }

            $user = $this->authService->login($data['email'], $data['password']);
            $this->success($user, 'Login successful');
        } catch (\Exception $e) {
            $this->error($e->getMessage(), 401);
        }
    }
}

