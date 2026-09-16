<?php

class CSRF
{
    public static function token()
    {
        Auth::iniciar();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function campo()
    {
        return '<input type="hidden" name="csrf_token" value="' .
            htmlspecialchars(self::token(), ENT_QUOTES, 'UTF-8') .
            '">';
    }

    public static function validar($token)
    {
        Auth::iniciar();

        return is_string($token) &&
            !empty($_SESSION['csrf_token']) &&
            hash_equals($_SESSION['csrf_token'], $token);
    }
}
