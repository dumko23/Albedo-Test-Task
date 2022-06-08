<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';
$data = $_POST["data"];
$send = new Controller();
$result = $send->registerNewMember($data);

echo $result;
