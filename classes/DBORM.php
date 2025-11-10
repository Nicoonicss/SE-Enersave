<?php

class DBORM implements iDBFuncs
{
    private ?\PDO $connection = null;

    public function connect(): void
    {
        if ($this->connection) {
            return;
        }
        $config = require __DIR__ . '/../config/database.php';
        $host = $config['host'];
        $db = $config['database'];
        $charset = $config['charset'];
        $port = $config['port'];
        $dsn = "mysql:host={$host};port={$port};dbname={$db};charset={$charset}";
        $username = $config['username'];
        $password = $config['password'];
        $this->connection = new \PDO($dsn, $username, $password, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]);
    }

    public function query(string $sql, array $params = []): array
    {
        $this->connect();
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function execute(string $sql, array $params = []): bool
    {
        $this->connect();
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params);
    }
}


