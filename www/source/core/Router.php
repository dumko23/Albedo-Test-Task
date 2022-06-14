<?php

namespace App\core;

class Router
{
    protected array $routes = [
        'POST' => [],
        'GET' => [],
        '404' => 'source/controllers/_404.php'
    ];

    public static function load($file){
        $router = new static;

        require $file;

        return $router;
    }

    public function redirect($uri, $requestMethod)
    {
        if (array_key_exists($uri, $this->routes[$requestMethod])) {
            return $this->routes[$requestMethod][$uri];
        } else {
            return $this->routes['404'];
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