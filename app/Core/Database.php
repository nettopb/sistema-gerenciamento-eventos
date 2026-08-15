<?php

class Database {
    private string $host = 'localhost';
    private string $db_name = 'sistema_eventos';
    private string $username = 'root';
    private string $password = '';
    private ?PDO $conn = null;

    public function getConnection(): ?PDO {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }

        return $this->conn;
    }
}