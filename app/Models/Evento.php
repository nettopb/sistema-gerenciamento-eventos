<?php

class Evento {
    private PDO $conn;
    private string $table = 'eventos';

    public int $id;
    public string $titulo;
    public string $descricao;
    public string $data_inicio;
    public string $data_fim;
    public string $local;
    public int $capacidade;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function listar(): array {
        $query = "SELECT * FROM {$this->table} ORDER BY data_inicio ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function criar(): bool {
        $query = "INSERT INTO {$this->table} (titulo, descricao, data_inicio, data_fim, local, capacidade) 
                  VALUES (:titulo, :descricao, :data_inicio, :data_fim, :local, :capacidade)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':titulo', htmlspecialchars(strip_tags($this->titulo)));
        $stmt->bindValue(':descricao', htmlspecialchars(strip_tags($this->descricao)));
        $stmt->bindValue(':data_inicio', $this->data_inicio);
        $stmt->bindValue(':data_fim', $this->data_fim);
        $stmt->bindValue(':local', htmlspecialchars(strip_tags($this->local)));
        $stmt->bindValue(':capacidade', $this->capacidade, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function atualizar(): bool {
        $query = "UPDATE {$this->table} 
                  SET titulo = :titulo, descricao = :descricao, data_inicio = :data_inicio, 
                      data_fim = :data_fim, local = :local, capacidade = :capacidade 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':titulo', htmlspecialchars(strip_tags($this->titulo)));
        $stmt->bindValue(':descricao', htmlspecialchars(strip_tags($this->descricao)));
        $stmt->bindValue(':data_inicio', $this->data_inicio);
        $stmt->bindValue(':data_fim', $this->data_fim);
        $stmt->bindValue(':local', htmlspecialchars(strip_tags($this->local)));
        $stmt->bindValue(':capacidade', $this->capacidade, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deletar(int $id): bool {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}