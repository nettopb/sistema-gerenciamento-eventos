<?php

class Router
{
    private array $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $path = parse_url($uri, PHP_URL_PATH);

        if (str_starts_with($path, BASE_PATH)) {
            $path = substr($path, strlen(BASE_PATH));
        }

        if ($path === '' || $path === false) {
            $path = '/';
        }

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        if (!isset($this->routes[$method][$path])) {

            http_response_code(404);

            echo '<!DOCTYPE html>';
            echo '<html lang="pt-BR">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<title>404</title>';
            echo '</head>';
            echo '<body>';
            echo '<h1>404</h1>';
            echo '<p>Página não encontrada.</p>';
            echo '<p>Rota: ' . htmlspecialchars($path) . '</p>';
            echo '<p><a href="' . url('/') . '">Voltar ao início</a></p>';
            echo '</body>';
            echo '</html>';

            return;
        }

        [$controllerName, $methodName] =
            explode('@', $this->routes[$method][$path]);

        $controllerFile =
            __DIR__ .
            '/../Controllers/' .
            $controllerName .
            '.php';

        if (!file_exists($controllerFile)) {

            http_response_code(500);

            echo 'Controller não encontrado.';

            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {

            http_response_code(500);

            echo 'Classe do Controller não encontrada.';

            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {

            http_response_code(500);

            echo 'Método do Controller não encontrado.';

            return;
        }

        $controller->$methodName();
    }
}