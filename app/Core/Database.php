<?php

class Database
{
    private static $pdo = null;

    public static function conectar()
    {
        if (self::$pdo === null) {

            $dsn = 'mysql:host=' . DB_HOST .
                ';dbname=' . DB_NAME .
                ';charset=utf8mb4';

            self::$pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASS
            );

            self::$pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            self::$pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
        }

        return self::$pdo;
    }
}