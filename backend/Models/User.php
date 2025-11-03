<?php

namespace Enersave\Models;

/**
 * User Model
 * Single Responsibility: Handle user-related database operations
 */
class User extends Model
{
    protected string $table = 'users';
    protected string $primaryKey = 'id';
    protected array $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'organization',
        'role',
        'bio',
        'created_at',
        'updated_at'
    ];
    protected array $hidden = ['password'];

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?array
    {
        return $this->findOneBy('email', $email);
    }

    /**
     * Find user by username
     */
    public function findByUsername(string $username): ?array
    {
        return $this->findOneBy('username', $username);
    }

    /**
     * Verify password
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Hash password
     */
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Create user with hashed password
     */
    public function createUser(array $data): int
    {
        if (isset($data['password'])) {
            $data['password'] = $this->hashPassword($data['password']);
        }
        
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->create($data);
    }

    /**
     * Find user with password (for login verification)
     */
    public function findWithPassword(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}

