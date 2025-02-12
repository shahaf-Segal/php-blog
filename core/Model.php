<?php

namespace Core;

abstract class Model
{
    protected static $table;

    public static function all(): array
    {
        $db = App::get('database');
        $results = $db->fetchAll("SELECT * FROM " . static::$table);
        return array_map([static::class, 'createFromArray'], $results);
    }
    public static function find(mixed $id): static|null
    {
        $db = App::get('database');
        $result = $db->fetch("SELECT * FROM " . static::$table . " WHERE id = :id", ['id' => $id]);
        return $result ? static::createFromArray($result) : null;
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

    protected static function createFromArray(array $data): static
    {
        $model = new static();
        foreach ($data as $key => $value) {
            if (property_exists($model, $key)) {
                $model->{$key} = $value;
            }
        }
        return $model;
    }
}
