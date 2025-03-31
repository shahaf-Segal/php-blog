<?php


namespace App\Services;

use App\Models\User;


class Auth
{

    protected static $user = null;

    public static function attempt(string $email, string $password): bool
    {
        $user = User::findByEmail($email);
        if ($user && $user->verifyPassword($password)) {
            //signed in
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user->id;
            return true;
        }
        return false;
    }
    public static function user(): ?User
    {
        if (static::$user) {
            return static::$user;
        }
        $userID = $_SESSION['user_id'] ?? null;
        return $userID ? User::find($userID) : null;
    }
    public static function logout(): void
    {
        session_destroy();
        static::$user = null;
    }
}
