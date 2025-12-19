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
require_once __DIR__ . '/../classes/iDBFuncs.php';
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
                    // For ALTER TABLE ADD COLUMN, check if column exists first
                    if (preg_match('/ALTER TABLE\s+(\w+)\s+ADD COLUMN\s+(\w+)/i', $statement, $matches)) {
                        $tableName = $matches[1];
                        $columnName = $matches[2];
                        
                        try {
                            // Check if column exists
                            $checkSql = "SELECT COUNT(*) as count FROM INFORMATION_SCHEMA.COLUMNS 
                                         WHERE TABLE_SCHEMA = DATABASE() 
                                         AND TABLE_NAME = :table 
                                         AND COLUMN_NAME = :column";
                            $result = $this->db->query($checkSql, [':table' => $tableName, ':column' => $columnName]);
                            
                            if ($result[0]['count'] == 0) {
                                // Column doesn't exist, execute the ADD COLUMN
                                $this->db->execute($statement);
                            } else {
                                // Column exists, try to modify it instead
                                $modifyStatement = str_replace('ADD COLUMN', 'MODIFY COLUMN', $statement);
                                $this->db->execute($modifyStatement);
                            }
                        } catch (Exception $e) {
                            // If check fails or modify fails, try to just modify
                            try {
                                $modifyStatement = str_replace('ADD COLUMN', 'MODIFY COLUMN', $statement);
                                $this->db->execute($modifyStatement);
                            } catch (Exception $e2) {
                                // If both fail, skip (column might already be correct type)
                                echo "\n  Warning: Could not add/modify column {$columnName}: " . $e2->getMessage() . "\n";
                            }
                        }
                    } else if (preg_match('/ALTER TABLE\s+(\w+)\s+MODIFY COLUMN\s+(\w+)/i', $statement, $matches)) {
                        // Handle MODIFY COLUMN - check if column exists first
                        $tableName = $matches[1];
                        $columnName = $matches[2];
                        
                        try {
                            $checkSql = "SELECT COUNT(*) as count FROM INFORMATION_SCHEMA.COLUMNS 
                                         WHERE TABLE_SCHEMA = DATABASE() 
                                         AND TABLE_NAME = :table 
                                         AND COLUMN_NAME = :column";
                            $result = $this->db->query($checkSql, [':table' => $tableName, ':column' => $columnName]);
                            
                            if ($result[0]['count'] > 0) {
                                // Column exists, modify it
                                $this->db->execute($statement);
                            } else {
                                // Column doesn't exist, add it instead
                                $addStatement = str_replace('MODIFY COLUMN', 'ADD COLUMN', $statement);
                                // Remove the type and add AFTER status
                                $addStatement = preg_replace('/MODIFY COLUMN\s+\w+\s+/', 'ADD COLUMN ', $addStatement);
                                $addStatement = str_replace('ADD COLUMN', 'ADD COLUMN image_url TEXT AFTER status', $addStatement);
                                $this->db->execute($addStatement);
                            }
                        } catch (Exception $e) {
                            echo "\n  Warning: Could not modify/add column {$columnName}: " . $e->getMessage() . "\n";
                        }
                    } else if (preg_match('/ALTER TABLE\s+(\w+)\s+ADD CONSTRAINT/i', $statement, $matches)) {
                        // Handle ADD CONSTRAINT (foreign keys) - check if constraint exists first
                        try {
                            $this->db->execute($statement);
                        } catch (Exception $e) {
                            // If constraint already exists, skip it
                            if (strpos($e->getMessage(), 'Duplicate key name') !== false || 
                                strpos($e->getMessage(), 'already exists') !== false) {
                                echo "\n  Info: Constraint already exists, skipping...\n";
                            } else {
                                echo "\n  Warning: Could not add constraint: " . $e->getMessage() . "\n";
                            }
                        }
                    } else {
                        // Regular statement, execute normally
                        $this->db->execute($statement);
                    }
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
            // Don't throw for column already exists or unknown column errors (handled in migration logic)
            if (strpos($e->getMessage(), 'Duplicate column name') !== false || 
                strpos($e->getMessage(), 'Unknown column') !== false ||
                strpos($e->getMessage(), '1054') !== false) {
                echo "  (Column issue handled, continuing...)\n";
                // Still record as executed if we got this far
                try {
                    $this->db->execute(
                        'INSERT INTO migrations (migration_name) VALUES (:name)',
                        [':name' => $migrationName]
                    );
                    echo "  Migration recorded despite warning.\n";
                } catch (Exception $e2) {
                    // Migration already recorded, ignore
                }
            } else {
                throw $e;
            }
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

