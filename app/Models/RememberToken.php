<?php

namespace App\Models;

use Core\Model;

class RememberToken extends Model
{
    protected static string $table = 'remember_tokens';
    private const TOKEN_LIFETIME = 60 * 60 * 24 * 30;

    public ?int $id;
    public string $token;
    public int $user_id;
    public string $created_at;
    public string $expires_at;

    public function rotate(): static
    {
        $this->token = static::generateToken();
        $this->expires_at = static::getExpiryDate();
        $this->save();
        return $this;
    }

    private static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }
    private static function getExpiryDate(): string
    {
        return date('Y-m-d H:i:s', time() + static::TOKEN_LIFETIME);
    }
    public static function createForUser(int $user_id): static
    {
        return static::create([
            'token' => static::generateToken(),
            'user_id' => $user_id,
            'expires_at' => static::getExpiryDate()
        ]);
    }
}
