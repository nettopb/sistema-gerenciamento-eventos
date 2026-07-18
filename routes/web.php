<?php

$router->get('/', 'HomeController@index');

$router->get('/login', 'AuthController@login');

$router->get('/eventos', 'EventoController@index');

$router->get('/eventos/novo', 'EventoController@create');