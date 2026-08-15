<?php

// Página inicial
$router->get(
    '/',
    'HomeController@index'
);

// Eventos - READ
$router->get(
    '/eventos',
    'EventoController@index'
);

// Formulário - CREATE
$router->get(
    '/eventos/novo',
    'EventoController@create'
);

// Salvar - CREATE
$router->post(
    '/eventos/salvar',
    'EventoController@store'
);

// Formulário - UPDATE
$router->get(
    '/eventos/editar',
    'EventoController@edit'
);

// Atualizar - UPDATE
$router->post(
    '/eventos/atualizar',
    'EventoController@update'
);

// DELETE
$router->get(
    '/eventos/excluir',
    'EventoController@delete'
);