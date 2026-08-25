<?php

require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Core/Auth.php';

class AuthController
{
    public function login()
    {
        if (Auth::autenticado()) {

            header(
                'Location: ' .
                url('/eventos')
            );

            exit;
        }

        $erro = null;

        require __DIR__ .
            '/../Views/auth/login.php';
    }

    public function autenticar()
    {
        $email =
            trim($_POST['email'] ?? '');

        $senha =
            $_POST['senha'] ?? '';

        if (
            $email === '' ||
            $senha === ''
        ) {
            $erro =
                'Informe e-mail e senha.';

            require __DIR__ .
                '/../Views/auth/login.php';

            return;
        }

        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {
            $erro =
                'Informe um e-mail válido.';

            require __DIR__ .
                '/../Views/auth/login.php';

            return;
        }

        $usuarioModel =
            new Usuario();

        $usuario =
            $usuarioModel
                ->buscarPorEmail($email);

        if (
            !$usuario ||
            !password_verify(
                $senha,
                $usuario['senha']
            )
        ) {
            $erro =
                'E-mail ou senha inválidos.';

            require __DIR__ .
                '/../Views/auth/login.php';

            return;
        }

        Auth::login($usuario);

        header(
            'Location: ' .
            url('/eventos')
        );

        exit;
    }

    public function logout()
    {
        Auth::logout();

        header(
            'Location: ' .
            url('/login')
        );

        exit;
    }
}