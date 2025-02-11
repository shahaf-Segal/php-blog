<?php

namespace Core;

use Exception;
use PDO;
use PDOStatement;

class DataBase
{
    protected $pdo;
    public function __construct(array $config)
    {
        try {
            $dsn = $this->createDsn($config);
            $dbUser = $config['username'] ?? "";
            $dbPassword = $config['password'] ?? "";
            $options = $config['options'] ?? [];

            $this->pdo = new PDO(
                dsn: $dsn,
                username: $dbUser,
                password: $dbPassword,
                options: $options
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception("Error:  Starting DataBase Failed");
        }
    }

    protected function createDsn(array $config): string
    {
        $driver = $config['driver'];
        $dbname = $config['dbname'];
        return match ($driver) {
            "sqlite" => "sqlite:$dbname",
            default => throw new Exception("Error: Driver Unsupported $driver"),
        };
    }
    public function query(string $sql, array $params = []): PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetch(string $sql, array $params = []): array|false
    {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }
    public function lastInertId(): string|false
    {
        return $this->pdo->lastInsertId();
    }
}
