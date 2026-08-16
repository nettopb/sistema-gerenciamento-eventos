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

        $basePath = BASE_PATH;

        if (str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
        }

        if ($path === '' || $path === false) {
            $path = '/';
        }

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        if (!isset($this->routes[$method][$path])) {

            http_response_code(404);

            echo '<h1>404 - Rota não encontrada</h1>';
            echo '<p>Método: ' . htmlspecialchars($method) . '</p>';
            echo '<p>URI: ' . htmlspecialchars($uri) . '</p>';
            echo '<p>Rota processada: ' . htmlspecialchars($path) . '</p>';

            echo '<p><a href="' . url('/') . '">Voltar ao início</a></p>';

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

            echo '<h1>Erro</h1>';
            echo '<p>Controller não encontrado:</p>';
            echo '<p>' . htmlspecialchars($controllerFile) . '</p>';

            return;
        }

        require_once $controllerFile;

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {

            http_response_code(500);

            echo '<h1>Erro</h1>';
            echo '<p>Método não encontrado:</p>';
            echo '<p>' .
                htmlspecialchars(
                    $controllerName . '@' . $methodName
                ) .
                '</p>';

            return;
        }

        $controller->$methodName();
    }
}