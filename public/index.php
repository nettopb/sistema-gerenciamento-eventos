<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../app/Core/Database.php';

require_once __DIR__ . '/../app/Core/Router.php';

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$uri = $_SERVER['REQUEST_URI'];

$router->dispatch($uri);