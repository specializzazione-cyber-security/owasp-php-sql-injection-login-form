<?php

namespace App\Modules;

class Csrf
{
    //generare il token
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    //verificare il token
    public static function verifyToken(string $token): bool
    {
        $sessionToken = $_SESSION['csrf_token'];
        return isset($sessionToken) && $sessionToken === $token;
    }

    //distruggere il token
    public static function destroyToken(string $token_key): void
    {
        unset($token_key);
    }
}
