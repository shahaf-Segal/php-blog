<?php

namespace App\Models;

use Core\Model;


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
        return static::find(['email' => $email]);
    }
    public function verifyPassword(string $password): bool
    {
        return password_verify($password . $this->salt, $this->password);
    }
}
