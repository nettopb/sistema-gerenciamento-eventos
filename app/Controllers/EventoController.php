<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Evento.php';

class EventoController {
    private PDO $db;
    private Evento $evento;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->evento = new Evento($this->db);
    }

    public function index(): void {
        header('Content-Type: application/json');
        echo json_encode($this->evento->listar());
    }

    public function show(int $id): void {
        header('Content-Type: application/json');
        $resultado = $this->evento->buscarPorId($id);

        if (!$resultado) {
            http_response_code(404);
            echo json_encode(['mensagem' => 'Evento não encontrado.']);
            return;
        }

        echo json_encode($resultado);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $dados = json_decode(file_get_contents("php://input"), true);

        if (empty($dados['titulo']) || empty($dados['data_inicio']) || empty($dados['data_fim'])) {
            http_response_code(400);
            echo json_encode(['mensagem' => 'Campos obrigatórios ausentes.']);
            return;
        }

        $this->evento->titulo = $dados['titulo'];
        $this->evento->descricao = $dados['descricao'] ?? '';
        $this->evento->data_inicio = $dados['data_inicio'];
        $this->evento->data_fim = $dados['data_fim'];
        $this->evento->local = $dados['local'] ?? '';
        $this->evento->capacidade = $dados['capacidade'] ?? 0;

        if ($this->evento->criar()) {
            http_response_code(201);
            echo json_encode(['mensagem' => 'Evento criado com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['mensagem' => 'Erro ao criar evento.']);
        }
    }

    public function destroy(int $id): void {
        header('Content-Type: application/json');

        if ($this->evento->deletar($id)) {
            echo json_encode(['mensagem' => 'Evento removido com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['mensagem' => 'Erro ao remover evento.']);
        }
    }
}