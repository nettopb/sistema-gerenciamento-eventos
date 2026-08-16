<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'eventos');
define('DB_USER', 'root');
define('DB_PASS', '');

define('BASE_PATH', '/sistema-gerenciamento-eventos/public');

error_reporting(E_ALL);
ini_set('display_errors', '1');

function url($path = '')
{
    return BASE_PATH . $path;
}