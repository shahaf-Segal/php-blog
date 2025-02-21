<?php

namespace Core;

use Core\Model;

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
    public function query(string $sql, array $params = [], ?string $class = null): PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        if ($class) {
            $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        $statement->execute($params);
        return $statement;
    }



    public function fetchAll(string $sql, array $params = [], ?string $class = null): array
    {
        $statement = $this->query($sql, $params, $class);
        return $statement->fetchAll();
    }
    public function fetch(string $sql, array $params = [], ?string $class = null): Model|false
    {
        $statement = $this->query($sql, $params, $class);
        $result = $statement->fetch();
        return $result;
    }
    public function lastInsertId(): string|false
    {
        return $this->pdo->lastInsertId();
    }
}
