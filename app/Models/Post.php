<?php

namespace App\Models;

use Core\Model;
use Core\App;

const DEFAULT_LIMIT = 10;

class Post extends Model
{
    protected static $table = 'posts';

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $views;
    public $created_at;

    public static function getRecent(?int $limit = DEFAULT_LIMIT, ?string $search = null, ?int $page = null): array
    {
        $db = App::get('database');
        $query = "SELECT * FROM " . static::$table;
        $params = [];
        if ($search) {
            $query .= " WHERE title LIKE ? OR content LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        $query .= " ORDER BY created_at DESC LIMIT ?";
        $params[] = $limit;

        if ($page) {
            $offset = ($page - 1) * $limit;
            $query .= " OFFSET ?";
            $params[] = $offset;
        }

        return $db->fetchAll($query, $params, static::class);
    }
    public function incrementViews(): void
    {
        $db = App::get('database');
        $db->query("UPDATE " . static::$table . " SET views = views + 1 WHERE id = ?", [$this->id]);
    }
    public static function count(?string $search = null): int
    {
        $db = App::get('database');

        $query = "SELECT COUNT(*) FROM " . static::$table;
        $params = [];

        if ($search) {
            $query .= " WHERE title LIKE ? OR content LIKE ?";
            $params = ["%$search%", "%$search%"];
        }

        return (int) $db->query($query, $params)->fetchColumn();
    }
}
