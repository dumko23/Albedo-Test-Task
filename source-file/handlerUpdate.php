<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';

echo $_POST['data']['firstName'];

print_r($_POST);

PDOAdapter::db();