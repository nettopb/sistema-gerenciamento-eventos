<?php

require_once __DIR__ . '/../Models/Evento.php';

class EventoController
{
    // LISTAGEM
    public function index()
    {
        $evento = new Evento();

        $lista = $evento->listar();

        require __DIR__ . '/../Views/evento/index.php';
    }

    // FORMULÁRIO DE CADASTRO
    public function create()
    {
        require __DIR__ . '/../Views/evento/create.php';
    }

    // SALVAR NOVO EVENTO
    public function store()
    {
        $titulo = trim($_POST['titulo'] ?? '');
        $data = $_POST['data_evento'] ?? '';
        $local = trim($_POST['local'] ?? '');

        // VALIDAÇÕES
        if ($titulo === '' || $data === '' || $local === '') {

            $erro = "Todos os campos são obrigatórios.";

            require __DIR__ . '/../Views/evento/create.php';

            return;
        }

        $evento = new Evento();

        $evento->salvar(
            $titulo,
            $data,
            $local
        );

        header("Location: /eventos?sucesso=cadastrado");

        exit;
    }

    // FORMULÁRIO DE EDIÇÃO
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {

            header("Location: /eventos?erro=invalid_id");

            exit;
        }

        $evento = new Evento();

        $registro = $evento->buscarPorId($id);

        if (!$registro) {

            header("Location: /eventos?erro=not_found");

            exit;
        }

        require __DIR__ . '/../Views/evento/edit.php';
    }

    // ATUALIZAR
    public function update()
    {
        $id = $_POST['id'] ?? null;

        $titulo = trim($_POST['titulo'] ?? '');

        $data = $_POST['data_evento'] ?? '';

        $local = trim($_POST['local'] ?? '');

        // VALIDAÇÃO
        if (
            !$id ||
            !is_numeric($id) ||
            $titulo === '' ||
            $data === '' ||
            $local === ''
        ) {

            $erro = "Todos os campos são obrigatórios.";

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

        $evento->atualizar(
            $id,
            $titulo,
            $data,
            $local
        );

        header("Location: /eventos?sucesso=atualizado");

        exit;
    }

    // EXCLUIR
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {

            header("Location: /eventos?erro=invalid_id");

            exit;
        }

        $evento = new Evento();

        $evento->excluir($id);

        header("Location: /eventos?sucesso=excluido");

        exit;
    }
}