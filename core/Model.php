<?php

namespace Core;

abstract class Model
{
    protected static $table;
    public $id;

    public static function all(): array
    {
        $db = App::get('database');
        return $db->fetchAll(
            "SELECT * FROM " . static::$table,
            [],
            static::class
        );
    }
    public static function find(mixed $id): static | false
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

    public function save(): static
    {
        $db = App::get('database');
        $data = get_object_vars($this);
        if (!isset($this->id)) {
            unset($data['id']);
            return static::create($data);
        }
        unset($data['id']);
        $setParts = array_map(
            fn($key) => "$key = ?",
            array_keys($data)
        );
        $sql = "UPDATE " . static::$table
            . " SET "
            . "$setParts" . " WHERE id = ?";
        $values = array_values($data);
        $values[] = $this->id;
        $db->query($sql, $values);
        return $this;
    }
}
