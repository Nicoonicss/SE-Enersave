<?php

class User
{
    private DBORM $db;

    public function __construct()
    {
        $this->db = new DBORM();
    }

    public function findByEmail(string $email): ?array
    {
        $rows = $this->db->query('SELECT * FROM users WHERE email = :email LIMIT 1', [':email' => $email]);
        return $rows[0] ?? null;
    }

    public function create(string $username, string $email, string $passwordHash, string $role = 'COMMUNITY_USER'): int
    {
        $this->db->execute('INSERT INTO users (username, email, password_hash, role) VALUES (:u, :e, :p, :r)', [
            ':u' => $username,
            ':e' => $email,
            ':p' => $passwordHash,
            ':r' => $role,
        ]);
        $row = $this->db->query('SELECT LAST_INSERT_ID() AS id');
        return (int)($row[0]['id'] ?? 0);
    }
}


