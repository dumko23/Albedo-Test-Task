<?php

namespace App\core;

use Exception;

class Application
{
    public Controller $controller;
    public View $view;
    public Router $router;
    public Model $model;
    public Request $request;
    protected array $config;

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->router = new Router();
        $this->request = new Request();
        $this->controller = new Controller();
        $this->config = require 'source/config.php';
    }

    public function getConfig(){
        return $this->config;
    }

    public function callAction($controller, $action){
        if (! method_exists($this->$controller, $action)){
            var_dump($controller, $action);
            throw new Exception("{$controller} does not respond to the {$action} action");
        }

        $result = $this->$controller->$action();
        return $this->view->showView($result);
    }
}