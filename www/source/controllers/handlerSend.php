<?php

namespace App;
use App\core\Application;

require __DIR__ . '/../vendor/autoload.php';

$data = $_POST["data"];
$config = require('source/config.php');

$send = new Application();
$result = $send->controller->registerNewMember($config, $data);

echo $result;
