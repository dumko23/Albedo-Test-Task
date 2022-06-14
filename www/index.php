<?php

namespace App;

use App\core\Application;

require __DIR__ . '/vendor/autoload.php';


$app = new Application();
$app->callAction(...$app->router
    ->load('source/routes.php')
    ->redirect($app->request->getUri($_SERVER['REQUEST_URI']),
        $app->request->getRequestMethod()));
//$app->router
//    ->load('source/routes.php')
//    ->redirect($app->request->getUri($_SERVER['REQUEST_URI']),
//        $app->request->getRequestMethod());
