<?php

namespace App\Models;

use Core\Model;
use Core\App;


class User extends Model
{

    protected static $table = 'users';

    public $id;
    public $name;
    public $email;
    protected $password;
    protected $salt;
    public $role;
    public $created_at;

    public static function findByEmail(string $email): User|false
    {
        $db = App::get('database');
        return $db->fetch(
            "SELECT * FROM " . static::$table . " WHERE email = ?",
            [$email],
            static::class
        );
    }
    public function verifyPassword(string $password): bool
    {
        return password_verify($password . $this->salt, $this->password);
    }
}
