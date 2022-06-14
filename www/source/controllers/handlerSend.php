<?php

namespace App;
use App\core\Application;

require './vendor/autoload.php';

$data = $_POST["data"];

$app = new Application();
$result = $app->controller->registerNewMember($app->getConfig(), $data);


echo $result;
