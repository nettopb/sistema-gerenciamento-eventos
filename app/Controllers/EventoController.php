<?php

class EventoController
{
    public function index()
    {
        require "../app/Views/evento/index.php";
    }

    public function create()
    {
        require "../app/Views/evento/create.php";
    }
}