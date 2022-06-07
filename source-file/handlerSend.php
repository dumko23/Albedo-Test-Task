<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';

$data = $_POST['data'];

PDOAdapter::insertToDB($data['firstName'],
    $data['lastName'],
    $data['date'],
    $data['subject'],
    $data['country'],
    $data['phone'],
    $data['email']);