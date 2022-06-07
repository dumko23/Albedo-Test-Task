<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';

echo $_POST['data']['firstName'];

print_r($_POST);

PDOAdapter::db();
PDOAdapter::insertToDB($_POST['data']['firstName'],
    $_POST['data']['lastName'],
    $_POST['data']['date'],
    $_POST['data']['subject'],
    $_POST['data']['country'],
    $_POST['data']['phone'],
    $_POST['data']['email']);