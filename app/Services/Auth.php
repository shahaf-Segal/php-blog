<?php


namespace App\Services;

use App\Models\User;
use App\Services\RememberMe;


class Auth
{

    protected static $user = null;

    public static function attempt(string $email, string $password, bool $remember = false): bool
    {
        $user = User::findByEmail($email);
        if ($user && $user->verifyPassword($password)) {
            //signed in
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user->id;
            if ($remember) {
                RememberMe::createToken($user->id);
            }
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
        return $userID ? User::find($userID) : RememberMe::validateToken();
    }
    public static function logout(): void
    {
        RememberMe::clearToken();
        session_destroy();
        static::$user = null;
    }
}
