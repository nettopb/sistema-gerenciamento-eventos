<?php

class Auth
{
    public static function iniciar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($usuario)
    {
        self::iniciar();

        session_regenerate_id(true);

        $_SESSION['usuario_id'] =
            $usuario['id'];

        $_SESSION['usuario_nome'] =
            $usuario['nome'];

        $_SESSION['usuario_email'] =
            $usuario['email'];

        $_SESSION['usuario_perfil'] =
            $usuario['perfil'];
    }

    public static function logout()
    {
        self::iniciar();

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $params =
                session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    public static function autenticado()
    {
        self::iniciar();

        return isset(
            $_SESSION['usuario_id']
        );
    }

    public static function usuario()
    {
        self::iniciar();

        if (!self::autenticado()) {
            return null;
        }

        return [
            'id' =>
                $_SESSION['usuario_id'],

            'nome' =>
                $_SESSION['usuario_nome'],

            'email' =>
                $_SESSION['usuario_email'],

            'perfil' =>
                $_SESSION['usuario_perfil']
        ];
    }

    public static function ehAdmin()
    {
        self::iniciar();

        return
            self::autenticado() &&
            (
                $_SESSION['usuario_perfil'] ?? ''
            ) === 'ADMIN';
    }
}