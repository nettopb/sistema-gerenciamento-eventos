<?php

require_once __DIR__ . '/../Models/Evento.php';

class EventoController
{
    public function index()
    {
        $evento = new Evento();
        $lista = $evento->listar();

        require __DIR__ . '/../Views/evento/index.php';
    }

    public function create()
    {
        $erro = null;

        require __DIR__ . '/../Views/evento/create.php';
    }

    public function store()
    {
        $titulo = trim($_POST['titulo'] ?? '');
        $data = trim($_POST['data_evento'] ?? '');
        $local = trim($_POST['local'] ?? '');

        if ($titulo === '' || $data === '' || $local === '') {
            $erro = 'Todos os campos são obrigatórios.';
            require __DIR__ . '/../Views/evento/create.php';
            return;
        }

        if (mb_strlen($titulo) > 150) {
            $erro = 'O título deve possuir no máximo 150 caracteres.';
            require __DIR__ . '/../Views/evento/create.php';
            return;
        }

        if (mb_strlen($local) > 120) {
            $erro = 'O local deve possuir no máximo 120 caracteres.';
            require __DIR__ . '/../Views/evento/create.php';
            return;
        }

        $dataValida = DateTime::createFromFormat('Y-m-d', $data);

        if (!$dataValida || $dataValida->format('Y-m-d') !== $data) {
            $erro = 'Informe uma data válida.';
            require __DIR__ . '/../Views/evento/create.php';
            return;
        }

        $evento = new Evento();
        $evento->salvar($titulo, $data, $local);

        header('Location: ' . BASE_URL . '/eventos?sucesso=cadastrado');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            header('Location: ' . BASE_URL . '/eventos?erro=invalid_id');
            exit;
        }

        $evento = new Evento();
        $registro = $evento->buscarPorId($id);

        if (!$registro) {
            header('Location: ' . BASE_URL . '/eventos?erro=not_found');
            exit;
        }

        $erro = null;

        require __DIR__ . '/../Views/evento/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        $titulo = trim($_POST['titulo'] ?? '');
        $data = trim($_POST['data_evento'] ?? '');
        $local = trim($_POST['local'] ?? '');

        if (!$id || !filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            $erro = 'Identificador inválido.';
            $registro = compact('id', 'titulo', 'data', 'local');
            require __DIR__ . '/../Views/evento/edit.php';
            return;
        }

        if ($titulo === '' || $data === '' || $local === '') {
            $erro = 'Todos os campos são obrigatórios.';
            $registro = [
                'id' => $id,
                'titulo' => $titulo,
                'data_evento' => $data,
                'local' => $local
            ];
            require __DIR__ . '/../Views/evento/edit.php';
            return;
        }

        $evento = new Evento();
        $evento->atualizar($id, $titulo, $data, $local);

        header('Location: ' . BASE_URL . '/eventos?sucesso=atualizado');
        exit;
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;

        if (!$id || !filter_var($id, FILTER_VALIDATE_INT) || $id <= 0) {
            header('Location: ' . BASE_URL . '/eventos?erro=invalid_id');
            exit;
        }

        $evento = new Evento();
        $evento->excluir($id);

        header('Location: ' . BASE_URL . '/eventos?sucesso=excluido');
        exit;
    }
}