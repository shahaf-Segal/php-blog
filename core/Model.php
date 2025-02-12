<?php

namespace Core;

abstract class Model
{
    protected $table;

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
    public function create(array $data): static
    {
        $db = App::get('database');
        $collumns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        // '?,' * count($data);
        $sql = "INSERT INTO " . static::$table . " ($collumns) VALUES (:" . $placeholders . ")";
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
