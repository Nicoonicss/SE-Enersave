<?php

namespace Enersave\Validators;

/**
 * Project Validator
 * Single Responsibility: Validate project data
 */
class ProjectValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        $errors = [];

        // Validate project name
        if (empty($data['project_name'])) {
            $errors[] = 'Project name is required';
        }

        // Validate community name
        if (empty($data['community_name'])) {
            $errors[] = 'Community name is required';
        }

        // Validate project description
        if (empty($data['project_description'])) {
            $errors[] = 'Project description is required';
        }

        // Validate location
        if (empty($data['location'])) {
            $errors[] = 'Location is required';
        }

        // Validate contact person
        if (empty($data['contact_person'])) {
            $errors[] = 'Contact person is required';
        }

        // Validate contact email
        if (empty($data['contact_email'])) {
            $errors[] = 'Contact email is required';
        } elseif (!filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid contact email format';
        }

        // Validate user_id
        if (empty($data['user_id'])) {
            $errors[] = 'User ID is required';
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException(implode(', ', $errors));
        }

        return true;
    }
}

