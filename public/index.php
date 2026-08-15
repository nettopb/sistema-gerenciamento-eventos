<?php

require_once '../config/config.php';

require_once '../app/Core/Router.php';

$router = new Router();

require_once '../routes/web.php';

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

$router->dispatch($uri);