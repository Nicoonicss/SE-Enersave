<?php

namespace Enersave\Validators;

/**
 * Registration Validator
 * Single Responsibility: Validate user registration data
 */
class RegistrationValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $errors = [];

        // Validate username
        if (empty($data['username'])) {
            $errors[] = 'Username is required';
        } elseif (strlen($data['username']) < 3) {
            $errors[] = 'Username must be at least 3 characters';
        }

        // Validate email
        if (empty($data['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        // Validate password
        if (empty($data['password'])) {
            $errors[] = 'Password is required';
        } elseif (strlen($data['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }

        // Validate first name
        if (empty($data['first_name'])) {
            $errors[] = 'First name is required';
        }

        // Validate last name
        if (empty($data['last_name'])) {
            $errors[] = 'Last name is required';
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException(implode(', ', $errors));
        }

        return true;
    }
}

