<?php

namespace Enersave\Validators;

/**
 * Validator Interface
 * Interface Segregation Principle: Define validation contracts
 */
interface ValidatorInterface
{
    public function validate(array $data): bool;
}

