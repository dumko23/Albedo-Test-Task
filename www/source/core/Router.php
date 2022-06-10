<?php

namespace App\core;

class Router
{
    protected array $routes = [];


    public function define($routes): void
    {
        $this->routes = $routes;
    }

    public function redirect($uri){
        if(array_key_exists($uri, $this->routes)){
            return $this->routes[$uri];
        } else {
            echo $uri . ' not found..';
        }
    }
}