<?php

require_once __DIR__ . '/../controllers/EventoController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = new EventoController();

if ($uri === '/api/eventos' && $method === 'GET') {
    $controller->index();
} elseif (preg_match('/^\/api\/eventos\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $controller->show((int)$matches[1]);
} elseif ($uri === '/api/eventos' && $method === 'POST') {
    $controller->store();
} elseif (preg_match('/^\/api\/eventos\/(\d+)$/', $uri, $matches) && $method === 'DELETE') {
    $controller->destroy((int)$matches[1]);
} else {
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['mensagem' => 'Rota não encontrada.']);
}