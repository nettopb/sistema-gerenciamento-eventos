<?php

require_once __DIR__ . '/../Core/Database.php';

class Evento
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::conectar();
    }

    public function salvar($titulo, $data, $local)
    {
        $sql = "
            INSERT INTO eventos
            (titulo, data_evento, local)
            VALUES (?, ?, ?)
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $titulo,
            $data,
            $local
        ]);
    }

    public function listar()
    {
        $sql = "
            SELECT
                id,
                titulo,
                data_evento,
                local
            FROM eventos
            ORDER BY data_evento ASC, id ASC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function buscarPorId($id)
    {
        $sql = "
            SELECT
                id,
                titulo,
                data_evento,
                local
            FROM eventos
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function atualizar($id, $titulo, $data, $local)
    {
        $sql = "
            UPDATE eventos
            SET
                titulo = ?,
                data_evento = ?,
                local = ?
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $titulo,
            $data,
            $local,
            $id
        ]);
    }

    public function excluir($id)
    {
        $sql = "
            DELETE FROM eventos
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}