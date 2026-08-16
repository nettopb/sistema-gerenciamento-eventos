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

        $dataValida = DateTime::createFromFormat(
            'Y-m-d',
            $data
        );

        if (
            !$dataValida ||
            $dataValida->format('Y-m-d') !== $data
        ) {

            $erro = 'Informe uma data válida.';

            require __DIR__ . '/../Views/evento/create.php';

            return;
        }

        try {

            $evento = new Evento();

            $evento->salvar(
                $titulo,
                $data,
                $local
            );

            header(
                'Location: ' .
                url('/eventos?sucesso=cadastrado')
            );

            exit;

        } catch (PDOException $e) {

            $erro = 'Não foi possível cadastrar o evento.';

            require __DIR__ . '/../Views/evento/create.php';
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (
            !$id ||
            !filter_var($id, FILTER_VALIDATE_INT) ||
            $id <= 0
        ) {

            header(
                'Location: ' .
                url('/eventos?erro=invalid_id')
            );

            exit;
        }

        $evento = new Evento();

        $registro = $evento->buscarPorId($id);

        if (!$registro) {

            header(
                'Location: ' .
                url('/eventos?erro=not_found')
            );

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

        $registro = [
            'id' => $id,
            'titulo' => $titulo,
            'data_evento' => $data,
            'local' => $local
        ];

        if (
            !$id ||
            !filter_var($id, FILTER_VALIDATE_INT) ||
            $id <= 0
        ) {

            $erro = 'Identificador do evento inválido.';

            require __DIR__ . '/../Views/evento/edit.php';

            return;
        }

        if ($titulo === '' || $data === '' || $local === '') {

            $erro = 'Todos os campos são obrigatórios.';

            require __DIR__ . '/../Views/evento/edit.php';

            return;
        }

        if (mb_strlen($titulo) > 150) {

            $erro = 'O título deve possuir no máximo 150 caracteres.';

            require __DIR__ . '/../Views/evento/edit.php';

            return;
        }

        if (mb_strlen($local) > 120) {

            $erro = 'O local deve possuir no máximo 120 caracteres.';

            require __DIR__ . '/../Views/evento/edit.php';

            return;
        }

        $dataValida = DateTime::createFromFormat(
            'Y-m-d',
            $data
        );

        if (
            !$dataValida ||
            $dataValida->format('Y-m-d') !== $data
        ) {

            $erro = 'Informe uma data válida.';

            require __DIR__ . '/../Views/evento/edit.php';

            return;
        }

        try {

            $evento = new Evento();

            $registroExistente =
                $evento->buscarPorId($id);

            if (!$registroExistente) {

                header(
                    'Location: ' .
                    url('/eventos?erro=not_found')
                );

                exit;
            }

            $evento->atualizar(
                $id,
                $titulo,
                $data,
                $local
            );

            header(
                'Location: ' .
                url('/eventos?sucesso=atualizado')
            );

            exit;

        } catch (PDOException $e) {

            $erro = 'Não foi possível atualizar o evento.';

            require __DIR__ . '/../Views/evento/edit.php';
        }
    }

    public function delete()
    {
        $id = $_POST['id'] ?? null;

        if (
            !$id ||
            !filter_var($id, FILTER_VALIDATE_INT) ||
            $id <= 0
        ) {

            header(
                'Location: ' .
                url('/eventos?erro=invalid_id')
            );

            exit;
        }

        try {

            $evento = new Evento();

            $registro = $evento->buscarPorId($id);

            if (!$registro) {

                header(
                    'Location: ' .
                    url('/eventos?erro=not_found')
                );

                exit;
            }

            $evento->excluir($id);

            header(
                'Location: ' .
                url('/eventos?sucesso=excluido')
            );

            exit;

        } catch (PDOException $e) {

            header(
                'Location: ' .
                url('/eventos?erro=delete')
            );

            exit;
        }
    }
}