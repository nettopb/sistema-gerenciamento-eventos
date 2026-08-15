<?php

require_once __DIR__ . '/../Core/Database.php';

class Evento
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::conectar();
    }

    // CREATE
    public function salvar($titulo, $data, $local)
    {
        $sql = "INSERT INTO eventos
                (titulo, data_evento, local)
                VALUES (?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $titulo,
            $data,
            $local
        ]);
    }

    // READ
    public function listar()
    {
        $sql = "SELECT * FROM eventos
                ORDER BY data_evento ASC";

        return $this->pdo
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ - buscar um evento
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM eventos
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function atualizar($id, $titulo, $data, $local)
    {
        $sql = "UPDATE eventos
                SET titulo = ?,
                    data_evento = ?,
                    local = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $titulo,
            $data,
            $local,
            $id
        ]);
    }

    // DELETE
    public function excluir($id)
    {
        $sql = "DELETE FROM eventos
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}