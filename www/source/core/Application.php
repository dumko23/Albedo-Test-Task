<?php

namespace App\core;

class Application
{
    public Controller $controller;
    public View $view;
    public Router $router;
    public array $routes = [];

    public function __construct()
    {
        $this->controller = new Controller();
        $this->view = new View();
        $this->router = new Router();
        $config = require 'source/config.php';
        $this->routes = $config['routes'];
        $this->router->define($this->routes);
    }
}