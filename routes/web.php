<?php

$router->get(
    '/',
    'HomeController@index'
);

$router->get(
    '/login',
    'AuthController@login'
);

$router->get(
    '/eventos',
    'EventoController@index'
);

$router->get(
    '/eventos/novo',
    'EventoController@create'
);

$router->post(
    '/eventos/salvar',
    'EventoController@store'
);

$router->get(
    '/eventos/editar',
    'EventoController@edit'
);

$router->post(
    '/eventos/atualizar',
    'EventoController@update'
);

$router->post(
    '/eventos/excluir',
    'EventoController@delete'
);