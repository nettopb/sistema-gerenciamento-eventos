<?php

$router->get('/','HomeController@index');

$router->get('/eventos','EventoController@index');

$router->get('/eventos/novo','EventoController@create');

$router->post('/eventos/salvar','EventoController@store');