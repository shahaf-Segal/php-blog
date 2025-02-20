<?php

namespace Core;

abstract class Model
{
    protected static $table;

    public static function all(): array
    {
        $db = App::get('database');
        return $db->fetchAll(
            "SELECT * FROM " . static::$table,
            [],
            static::class
        );
    }
    public static function find(mixed $id): static|null
    {
        $db = App::get('database');
        return $db->fetch(
            "SELECT * FROM " . static::$table . " WHERE id = ?",
            [$id],
            static::class
        );
    }
    public static function create(array $data): static
    {
        $db = App::get('database');
        $collumns = implode(',', array_keys($data));
        $placeholders = implode(',', array_map(fn($key) => ':' . $key, array_keys($data)));
        $sql = "INSERT INTO " . static::$table . " ($collumns) VALUES ($placeholders)";
        $db->query($sql, $data);
        return static::find($db->lastInsertId());
    }
}
