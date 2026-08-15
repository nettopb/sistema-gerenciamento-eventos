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

        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
        $basePath = dirname($scriptName);

        if ($basePath !== '/' && $basePath !== '.') {
            if (str_starts_with($uri, $basePath)) {
                $uri = substr($uri, strlen($basePath));
            }
        }

        if ($uri === '' || $uri === false) {
            $uri = '/';
        }

        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);

            echo '<h1>404</h1>';
            echo '<p>Página não encontrada.</p>';

            return;
        }

        [$controllerName, $methodName] =
            explode('@', $this->routes[$method][$uri]);

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

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {
            http_response_code(500);

            echo 'Método do Controller não encontrado.';

            return;
        }

        $controller->$methodName();
    }
}