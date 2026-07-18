<?php

require "../app/Core/Router.php";

require "../app/Controllers/HomeController.php";
require "../app/Controllers/AuthController.php";
require "../app/Controllers/EventoController.php";

$router = new Router();

require "../routes/web.php";

$uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);

$router->dispatch($uri);