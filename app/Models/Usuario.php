<?php

require_once __DIR__ . '/../Core/Model.php';

class Usuario extends Model
{
    public function buscarPorEmail($email)
    {
        $sql = 'SELECT id, nome, email, senha, perfil FROM usuarios WHERE email = ? LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function buscarPorId($id)
    {
        $sql = 'SELECT id, nome, email, perfil FROM usuarios WHERE id = ? LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
