<?php

namespace App\core;


class Router
{
    protected array $routes = [
        'POST' => [],
        'GET' => [],
        '404' => 'controller@get404'
    ];

    public static function load($file): static
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function redirect($uri, $requestMethod): array
    {
        if (array_key_exists($uri, $this->routes[$requestMethod])) {
            return explode('@', $this->routes[$requestMethod][$uri]);
        } else {
            return explode('@', $this->routes['404']);
        }
    }

    public function get($uri, $controller): void
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller): void
    {
        $this->routes['POST'][$uri] = $controller;
    }


}