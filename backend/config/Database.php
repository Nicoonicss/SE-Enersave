<?php

namespace Enersave\Config;

use PDO;
use PDOException;

/**
 * Database Configuration and Connection
 * Single Responsibility: Manage database connections only
 */
class Database
{
    private static ?PDO $instance = null;
    private static array $config;

    /**
     * Singleton pattern to ensure single database connection
     */
    private function __construct()
    {
        // Prevent instantiation
    }

    /**
     * Initialize database configuration
     */
    public static function init(array $config): void
    {
        self::$config = $config;
    }

    /**
     * Get database connection instance
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                $dsn = sprintf(
                    '%s:host=%s;dbname=%s;charset=utf8mb4',
                    self::$config['driver'],
                    self::$config['host'],
                    self::$config['database']
                );

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => false
                ];

                self::$instance = new PDO(
                    $dsn,
                    self::$config['username'],
                    self::$config['password'],
                    $options
                );
            } catch (PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
                throw new \RuntimeException("Unable to connect to database");
            }
        }

        return self::$instance;
    }

    /**
     * Prevent cloning
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserialization
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}

