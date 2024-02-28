<?php

namespace App\Modules;

class Csrf
{
    /**
     * Genera un CSRF token casuale
     * 
     * @return string
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Confronta il CSRF token della sessione rispetto quello presente nella request 
     * 
     * @param string $token
     * @return bool
     */
    public static function verifyToken(string $token): bool
    {
        $sessionToken = $_SESSION['csrf_token'];
        return isset($sessionToken) && $sessionToken === $token;
    }

    /**
     * Distrugge il CSRF token
     * @param string $token_key
     * @return void
     */
    public static function destroyToken(string $token_key): void
    {
        unset($token_key);
    }
}
