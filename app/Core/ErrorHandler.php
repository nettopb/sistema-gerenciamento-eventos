<?php

class ErrorHandler
{
    public static function registrar()
    {
        ini_set('display_errors', '0');
        ini_set('log_errors', '1');
        ini_set('error_log', LOG_FILE);
        error_reporting(E_ALL);

        set_exception_handler(function (Throwable $exception) {
            error_log(
                sprintf(
                    '[%s] %s in %s:%d%s',
                    date('Y-m-d H:i:s'),
                    $exception->getMessage(),
                    $exception->getFile(),
                    $exception->getLine(),
                    PHP_EOL . $exception->getTraceAsString()
                )
            );

            http_response_code(500);
            require __DIR__ . '/../Views/errors/500.php';
            exit;
        });
    }
}
