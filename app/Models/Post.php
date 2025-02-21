<?php

namespace App\Models;

use Core\Model;
use Core\App;

class Post extends Model
{
    protected static $table = 'posts';

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $views;
    public $created_at;

    public static function getRecent(int $limit): array
    {
        $db = App::get('database');
        return $db->fetchAll("SELECT * FROM " . static::$table . " ORDER BY created_at DESC LIMIT ?", [$limit], static::class);
    }
}
