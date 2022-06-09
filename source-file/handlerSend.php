<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';

$data = $_POST["data"];
$config = require('config/config.php');

$send = new Controller();
$result = $send->registerNewMember($config, $data);

echo $result;
