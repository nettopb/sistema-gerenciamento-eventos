<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/CSRF.php';

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::autenticado()) {
            $this->redirect('/eventos');
        }

        $this->view('auth/login', ['erro' => null]);
    }

    public function autenticar()
    {
        if (!CSRF::validar($_POST['csrf_token'] ?? null)) {
            $this->abort(403, 'Token de segurança inválido. Atualize a página e tente novamente.');
        }

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            $this->view('auth/login', ['erro' => 'Informe e-mail e senha.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->view('auth/login', ['erro' => 'Informe um e-mail válido.']);
            return;
        }

        $usuario = (new Usuario())->buscarPorEmail($email);

        if (!$usuario || !password_verify($senha, $usuario['senha'])) {
            $this->view('auth/login', ['erro' => 'E-mail ou senha inválidos.']);
            return;
        }

        Auth::login($usuario);
        $this->redirect('/eventos');
    }

    public function logout()
    {
        if (!CSRF::validar($_POST['csrf_token'] ?? null)) {
            $this->abort(403, 'Token de segurança inválido.');
        }

        Auth::logout();
        $this->redirect('/login');
    }
}
