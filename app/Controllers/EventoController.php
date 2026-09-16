<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Evento.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/CSRF.php';

class EventoController extends Controller
{
    private function exigirLogin()
    {
        if (!Auth::autenticado()) {
            $this->redirect('/login');
        }
    }

    private function exigirAdmin()
    {
        $this->exigirLogin();

        if (!Auth::ehAdmin()) {
            $this->abort(403, 'Você não possui permissão para realizar esta operação.');
        }
    }

    private function validarDados($titulo, $data, $local)
    {
        if ($titulo === '' || $data === '' || $local === '') {
            return 'Todos os campos são obrigatórios.';
        }

        if (mb_strlen($titulo) > 150) {
            return 'O título deve possuir no máximo 150 caracteres.';
        }

        if (mb_strlen($local) > 120) {
            return 'O local deve possuir no máximo 120 caracteres.';
        }

        $dataValida = DateTime::createFromFormat('Y-m-d', $data);

        if (!$dataValida || $dataValida->format('Y-m-d') !== $data) {
            return 'Data inválida.';
        }

        return null;
    }

    public function index()
    {
        $this->exigirLogin();
        $lista = (new Evento())->listar();
        $this->view('evento/index', ['lista' => $lista]);
    }

    public function create()
    {
        $this->exigirAdmin();
        $this->view('evento/create', ['erro' => null]);
    }

    public function store()
    {
        $this->exigirAdmin();

        if (!CSRF::validar($_POST['csrf_token'] ?? null)) {
            $this->abort(403, 'Token de segurança inválido. Atualize a página e tente novamente.');
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $data = trim($_POST['data_evento'] ?? '');
        $local = trim($_POST['local'] ?? '');
        $erro = $this->validarDados($titulo, $data, $local);

        if ($erro) {
            $this->view('evento/create', ['erro' => $erro]);
            return;
        }

        if (!(new Evento())->salvar($titulo, $data, $local)) {
            $this->view('evento/create', ['erro' => 'Não foi possível cadastrar o evento.']);
            return;
        }

        $this->redirect('/eventos?sucesso=cadastrado');
    }

    public function edit()
    {
        $this->exigirAdmin();
        $id = $_GET['id'] ?? null;

        if (!$id || !filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            $this->redirect('/eventos?erro=id_invalido');
        }

        $registro = (new Evento())->buscarPorId($id);

        if (!$registro) {
            $this->redirect('/eventos?erro=nao_encontrado');
        }

        $this->view('evento/edit', ['registro' => $registro, 'erro' => null]);
    }

    public function update()
    {
        $this->exigirAdmin();

        if (!CSRF::validar($_POST['csrf_token'] ?? null)) {
            $this->abort(403, 'Token de segurança inválido. Atualize a página e tente novamente.');
        }

        $id = $_POST['id'] ?? null;
        $titulo = trim($_POST['titulo'] ?? '');
        $data = trim($_POST['data_evento'] ?? '');
        $local = trim($_POST['local'] ?? '');

        if (!$id || !filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            $this->redirect('/eventos?erro=id_invalido');
        }

        $registro = [
            'id' => $id,
            'titulo' => $titulo,
            'data_evento' => $data,
            'local' => $local
        ];

        $erro = $this->validarDados($titulo, $data, $local);

        if ($erro) {
            $this->view('evento/edit', ['registro' => $registro, 'erro' => $erro]);
            return;
        }

        $evento = new Evento();

        if (!$evento->buscarPorId($id)) {
            $this->redirect('/eventos?erro=nao_encontrado');
        }

        if (!$evento->atualizar($id, $titulo, $data, $local)) {
            $this->view('evento/edit', ['registro' => $registro, 'erro' => 'Não foi possível atualizar o evento.']);
            return;
        }

        $this->redirect('/eventos?sucesso=atualizado');
    }

    public function delete()
    {
        $this->exigirAdmin();

        if (!CSRF::validar($_POST['csrf_token'] ?? null)) {
            $this->abort(403, 'Token de segurança inválido. Atualize a página e tente novamente.');
        }

        $id = $_POST['id'] ?? null;

        if (!$id || !filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            $this->redirect('/eventos?erro=id_invalido');
        }

        $evento = new Evento();

        if (!$evento->buscarPorId($id)) {
            $this->redirect('/eventos?erro=nao_encontrado');
        }

        if (!$evento->excluir($id)) {
            $this->redirect('/eventos?erro=exclusao');
        }

        $this->redirect('/eventos?sucesso=excluido');
    }
}
