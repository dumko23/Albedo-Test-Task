<?php

namespace App\core;

use App\app\controllers\Controller;
use App\app\controllers\HandleController;
use App\app\models\Model;
use App\app\views\View;
use Exception;

class Application
{
    public Controller $controller;
    public View $view;
    public Router $router;
    public Model $model;
    public Request $request;
    public HandleController $handleController;
    protected array $config;

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
        $this->router = new Router();
        $this->request = new Request();
        $this->controller = new Controller();
        $this->handleController = new HandleController();
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
        if($action === 'send' || $action === 'update'){
            return require $this->handleController->$action();
        }
        $result = $this->$controller->$action();
        return $this->view->showView($result);
    }
}