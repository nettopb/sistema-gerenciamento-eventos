<?php

class Router
{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if(isset($this->routes[$method][$uri])){

            [$controller,$function] = explode('@',$this->routes[$method][$uri]);

            $controller = new $controller();

            $controller->$function();

            return;
        }

        echo "404";
    }
}