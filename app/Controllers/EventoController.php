<?php

require_once __DIR__.'/../Models/Evento.php';

class EventoController
{

    public function index()
    {

        $evento = new Evento();

        $lista = $evento->listar();

        require __DIR__.'/../Views/evento/index.php';

    }

    public function create()
    {

        require __DIR__.'/../Views/evento/create.php';

    }

    public function store()
    {

        $evento = new Evento();

        $evento->salvar(

            $_POST['titulo'],

            $_POST['data_evento'],

            $_POST['local']

        );

        header("Location: /eventos");

    }

}