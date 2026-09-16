<?php

$localConfig = [];
$localConfigFile = __DIR__ . '/config.local.php';

if (is_file($localConfigFile)) {
    $loadedConfig = require $localConfigFile;
    if (is_array($loadedConfig)) {
        $localConfig = $loadedConfig;
    }
}

function configValue($key, $default = '')
{
    global $localConfig;

    if (array_key_exists($key, $localConfig)) {
        return $localConfig[$key];
    }

    $value = getenv($key);
    return $value === false ? $default : $value;
}

define('DB_HOST', configValue('EVENTOS_DB_HOST', 'localhost'));
define('DB_NAME', configValue('EVENTOS_DB_NAME', 'eventos'));
define('DB_USER', configValue('EVENTOS_DB_USER', 'root'));
define('DB_PASS', configValue('EVENTOS_DB_PASS', ''));

define('LOG_FILE', __DIR__ . '/../storage/logs/app.log');

$scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$scriptDirectory = $scriptDirectory === '/' || $scriptDirectory === '.' ? '' : rtrim($scriptDirectory, '/');

define('BASE_PATH', $scriptDirectory);

ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', LOG_FILE);
error_reporting(E_ALL);

function url($path = '')
{
    $path = '/' . ltrim($path, '/');
    return BASE_PATH . ($path === '/' ? '/' : $path);
}
