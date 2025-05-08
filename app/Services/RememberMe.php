<?php

namespace App\Services;

use App\Models\RememberToken;
use App\Models\User;

class RememberMe
{
    private const COOKIE_NAME = 'remember_token';
    public static function createToken(int $user_id): RememberToken
    {
        $token = RememberToken::createForUser($user_id);
        static::setCookie($token->token);
        return $token;
    }
    private static function setCookie(string $token): void
    {
        $expiresAt = time() +  RememberToken::TOKEN_LIFETIME;
        setcookie(
            static::COOKIE_NAME,
            $token,
            $expiresAt,
            '/',
            '',
            true,
            true
        );
    }
    public static function validateToken(): ?User
    {
        $token = static::getToken();
        if (!$token) {
            return null;
        }
        $user = User::find($token->user_id);
        if (!$user) {
            return null;
        }
        static::rotateCookie($token);
        return $user;
    }
    public static function clearToken(): void
    {
        $token = static::getToken();
        if ($token) {
            $token->delete();
        }
        static::destroyCookie();
    }
    private static function getToken(): ?RememberToken
    {
        $tokenString = $_COOKIE[static::COOKIE_NAME] ?? null;
        if (!$tokenString) {
            return null;
        }
        $token = RememberToken::findValid($tokenString);
        return $token;
    }

    private static function rotateCookie(RememberToken $token): void
    {
        $token->rotate();
        static::setCookie($token->token);
    }
    public static function destroyCookie(): void
    {
        setCookie(static::COOKIE_NAME, '', time() - 3600, '/', '', true, true);
    }
}
