<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'eventos');
define('DB_USER', 'root');
define('DB_PASS', '');

define('BASE_PATH', '/sistema-gerenciamento-eventos/public');

function url($path = '')
{
    return BASE_PATH . $path;
}