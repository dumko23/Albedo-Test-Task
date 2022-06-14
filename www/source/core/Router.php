<?php

namespace App\core;

class Router
{
    protected array $routes = [];


    public function define($routes): void
    {
        $this->routes = $routes;
    }

    public function redirect($uri, $requestMethod){
        if(array_key_exists($uri, $this->routes[$requestMethod])){
            return $this->routes[$requestMethod][$uri];
        } else {
            return $this->routes['404'];
        }
    }

    public function get(){

    }

    public function post(){

    }
}