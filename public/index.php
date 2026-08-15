<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Router.php';

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

$router->dispatch($uri);