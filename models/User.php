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

    public function createPasswordResetToken(int $userId, string $token): void
    {
        // Create password_reset_tokens table if it doesn't exist
        $this->db->execute(
            'CREATE TABLE IF NOT EXISTS password_reset_tokens (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT UNSIGNED NOT NULL,
                token VARCHAR(64) NOT NULL UNIQUE,
                expires_at TIMESTAMP NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                KEY idx_token (token),
                KEY idx_user_id (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
        );

        // Delete old tokens for this user
        $this->db->execute('DELETE FROM password_reset_tokens WHERE user_id = :user_id', [':user_id' => $userId]);

        // Insert new token (expires in 1 hour)
        $expiresAt = date('Y-m-d H:i:s', time() + 3600);
        $this->db->execute(
            'INSERT INTO password_reset_tokens (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)',
            [
                ':user_id' => $userId,
                ':token' => $token,
                ':expires_at' => $expiresAt,
            ]
        );
    }

    public function findByResetToken(string $token): ?int
    {
        // Create table if it doesn't exist
        $this->db->execute(
            'CREATE TABLE IF NOT EXISTS password_reset_tokens (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT UNSIGNED NOT NULL,
                token VARCHAR(64) NOT NULL UNIQUE,
                expires_at TIMESTAMP NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                KEY idx_token (token),
                KEY idx_user_id (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
        );

        $rows = $this->db->query(
            'SELECT user_id FROM password_reset_tokens WHERE token = :token AND expires_at > NOW() LIMIT 1',
            [':token' => $token]
        );
        return $rows[0]['user_id'] ?? null;
    }

    public function updatePassword(int $userId, string $passwordHash): void
    {
        $this->db->execute(
            'UPDATE users SET password_hash = :hash WHERE id = :id',
            [
                ':hash' => $passwordHash,
                ':id' => $userId,
            ]
        );
    }

    public function deleteResetToken(string $token): void
    {
        $this->db->execute('DELETE FROM password_reset_tokens WHERE token = :token', [':token' => $token]);
    }
}


