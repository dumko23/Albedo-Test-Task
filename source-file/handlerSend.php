<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';

$data = $_POST['data'];

print_r($_POST);
print_r($_FILES);


PDOAdapter::insertToDB($data['firstName'],
    $data['lastName'],
    $data['date'],
    $data['subject'],
    $data['country'],
    $data['phone'],
    $data['email']);