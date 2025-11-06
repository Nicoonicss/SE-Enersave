<?php

namespace Enersave\Services;

use Enersave\Repositories\UserRepository;
use Enersave\Validators\ValidatorInterface;

/**
 * Authentication Service
 * Single Responsibility: Handle authentication business logic
 * Open/Closed Principle: Can be extended without modification
 */
class AuthService
{
    private UserRepository $userRepository;
    private ?ValidatorInterface $validator;

    public function __construct(UserRepository $userRepository, ?ValidatorInterface $validator = null)
    {
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }

    /**
     * Register a new user
     */
    public function register(array $data): array
    {
        // Validate data if validator is provided
        if ($this->validator) {
            $this->validator->validate($data);
        }

        // Check if email already exists
        $existingUser = $this->userRepository->findByEmail($data['email']);
        if ($existingUser) {
            throw new \Exception('Email already registered');
        }

        // Check if username already exists
        $existingUsername = $this->userRepository->findByUsername($data['username']);
        if ($existingUsername) {
            throw new \Exception('Username already taken');
        }

        // Create user
        $userId = $this->userRepository->create($data);

        // Return user data
        return $this->userRepository->find($userId);
    }

    /**
     * Authenticate user
     */
    public function login(string $email, string $password): array
    {
        $user = $this->userRepository->findByEmail($email);
        
        if (!$user) {
            throw new \Exception('Invalid credentials');
        }

        // For login, we need the password from database
        $userWithPassword = $this->userRepository->findWithPassword($user['id']);
        if (!$userWithPassword || !$this->userRepository->verifyPassword($password, $userWithPassword['password'])) {
            throw new \Exception('Invalid credentials');
        }

        return $user;
    }
}

