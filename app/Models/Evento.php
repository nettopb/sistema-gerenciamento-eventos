<?php

require_once __DIR__.'/../Core/Database.php';

class Evento
{

    private $pdo;

    public function __construct()
    {

        $this->pdo = Database::conectar();

    }

    public function salvar($titulo,$data,$local)
    {

        $sql = "INSERT INTO eventos
                (titulo,data_evento,local)

                VALUES(?,?,?)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$titulo,$data,$local]);

    }

    public function listar()
    {

        $sql="SELECT * FROM eventos";

        return $this->pdo->query($sql)->fetchAll();

    }

}