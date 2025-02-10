<?php

namespace Core;

use Exception;
use PDO;

class DataBase
{
    protected $pdo;
    public function __construct(array $config)
    {
        try {
            $dsn = $this->createDsn($config);
            $this->pdo = new PDO($dsn);
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
}
