<?php
namespace App;
use App\core\Application;

require __DIR__ . '/vendor/autoload.php';

$app = new Application();

$uri = $app->request->getUri($_SERVER['REQUEST_URI']);


require $app->router->redirect($uri, $_SERVER['REQUEST_METHOD']);



