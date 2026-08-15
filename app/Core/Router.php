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

        if (!isset($this->routes[$method][$uri])) {

            http_response_code(404);

            echo "Página não encontrada.";

            return;
        }

        [$controllerName, $methodName] =
            explode('@', $this->routes[$method][$uri]);

        require_once __DIR__ .
            "/../Controllers/{$controllerName}.php";

        $controller = new $controllerName();

        $controller->$methodName();
    }
}