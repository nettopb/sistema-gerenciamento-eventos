<?php

class Usuario {
    private PDO $conn;
    private string $table = 'usuarios';

    public int $id;
    public string $nome;
    public string $email;
    public string $senha;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function cadastrar(): bool {
        $query = "INSERT INTO {$this->table} (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);

        $senhaHash = password_hash($this->senha, PASSWORD_ARGON2ID);

        $stmt->bindValue(':nome', htmlspecialchars(strip_tags($this->nome)));
        $stmt->bindValue(':email', filter_var($this->email, FILTER_SANITIZE_EMAIL));
        $stmt->bindValue(':senha', $senhaHash);

        return $stmt->execute();
    }

    public function autenticar(string $email, string $senha): ?array {
        $query = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', filter_var($email, FILTER_SANITIZE_EMAIL));
        $stmt->execute();

        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            unset($usuario['senha']);
            return $usuario;
        }

        return null;
    }
}