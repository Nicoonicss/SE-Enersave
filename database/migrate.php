<?php
/**
 * Migration Runner for Enersave Database
 * 
 * This script runs all pending migrations in the database/migrations directory.
 * Migrations are executed in alphabetical order and tracked in the migrations table.
 * 
 * Usage: php database/migrate.php
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/DBORM.php';

class MigrationRunner
{
    private DBORM $db;
    private string $migrationsDir;
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/database.php';
        $this->db = new DBORM();
        $this->migrationsDir = __DIR__ . '/migrations';
    }

    public function run(): void
    {
        echo "Starting database migrations...\n\n";

        // Connect to database
        $this->db->connect();

        // Create migrations table if it doesn't exist
        $this->createMigrationsTable();

        // Get all migration files
        $migrationFiles = $this->getMigrationFiles();

        if (empty($migrationFiles)) {
            echo "No migration files found.\n";
            return;
        }

        // Get executed migrations
        $executedMigrations = $this->getExecutedMigrations();

        // Run pending migrations
        $pendingMigrations = array_diff($migrationFiles, $executedMigrations);

        if (empty($pendingMigrations)) {
            echo "All migrations are up to date.\n";
            return;
        }

        echo "Found " . count($pendingMigrations) . " pending migration(s).\n\n";

        foreach ($pendingMigrations as $migration) {
            $this->runMigration($migration);
        }

        echo "\nMigration completed successfully!\n";
    }

    private function createMigrationsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            migration_name VARCHAR(255) NOT NULL UNIQUE,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_migration_name (migration_name)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

        $this->db->execute($sql);
    }

    private function getMigrationFiles(): array
    {
        $files = glob($this->migrationsDir . '/*.sql');
        $migrations = [];

        foreach ($files as $file) {
            $migrations[] = basename($file);
        }

        sort($migrations);
        return $migrations;
    }

    private function getExecutedMigrations(): array
    {
        try {
            $rows = $this->db->query('SELECT migration_name FROM migrations');
            return array_column($rows, 'migration_name');
        } catch (Exception $e) {
            // Table doesn't exist yet, return empty array
            return [];
        }
    }

    private function runMigration(string $migrationName): void
    {
        $filePath = $this->migrationsDir . '/' . $migrationName;

        if (!file_exists($filePath)) {
            echo "ERROR: Migration file not found: {$migrationName}\n";
            return;
        }

        echo "Running migration: {$migrationName}... ";

        try {
            $sql = file_get_contents($filePath);

            // Remove SQL comments (lines starting with --)
            $lines = explode("\n", $sql);
            $cleanedLines = [];
            foreach ($lines as $line) {
                $trimmed = trim($line);
                // Skip comment lines and empty lines
                if (!empty($trimmed) && !preg_match('/^--/', $trimmed)) {
                    $cleanedLines[] = $line;
                }
            }
            $sql = implode("\n", $cleanedLines);

            // Split by semicolon and execute each statement
            $statements = explode(';', $sql);
            foreach ($statements as $statement) {
                $statement = trim($statement);
                if (!empty($statement)) {
                    $this->db->execute($statement);
                }
            }

            // Record migration as executed
            $this->db->execute(
                'INSERT INTO migrations (migration_name) VALUES (:name)',
                [':name' => $migrationName]
            );

            echo "✓\n";
        } catch (Exception $e) {
            echo "✗\n";
            echo "ERROR: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    public function rollback(string $migrationName = null): void
    {
        echo "Rolling back migrations...\n\n";

        $this->db->connect();

        if ($migrationName) {
            // Rollback specific migration
            $this->removeMigrationRecord($migrationName);
            echo "Rolled back: {$migrationName}\n";
        } else {
            // Rollback last migration
            $lastMigration = $this->getLastMigration();
            if ($lastMigration) {
                $this->removeMigrationRecord($lastMigration);
                echo "Rolled back: {$lastMigration}\n";
            } else {
                echo "No migrations to rollback.\n";
            }
        }
    }

    private function getLastMigration(): ?string
    {
        $rows = $this->db->query('SELECT migration_name FROM migrations ORDER BY executed_at DESC LIMIT 1');
        return $rows[0]['migration_name'] ?? null;
    }

    private function removeMigrationRecord(string $migrationName): void
    {
        $this->db->execute(
            'DELETE FROM migrations WHERE migration_name = :name',
            [':name' => $migrationName]
        );
    }

    public function status(): void
    {
        echo "Migration Status:\n\n";

        $this->db->connect();
        $this->createMigrationsTable();

        $migrationFiles = $this->getMigrationFiles();
        $executedMigrations = $this->getExecutedMigrations();

        foreach ($migrationFiles as $migration) {
            $status = in_array($migration, $executedMigrations) ? '✓ Executed' : '○ Pending';
            echo "  {$status}: {$migration}\n";
        }
    }
}

// Run migrations if called directly
if (php_sapi_name() === 'cli') {
    $runner = new MigrationRunner();

    $command = $argv[1] ?? 'run';

    switch ($command) {
        case 'run':
            $runner->run();
            break;
        case 'status':
            $runner->status();
            break;
        case 'rollback':
            $migrationName = $argv[2] ?? null;
            $runner->rollback($migrationName);
            break;
        default:
            echo "Usage: php database/migrate.php [run|status|rollback [migration_name]]\n";
            break;
    }
}

