<?php

namespace App;

use Error;

require __DIR__ . '/../vendor/autoload.php';


$data = $_POST['data'];

$uploadDir = './uploads/';

$basename = basename($_FILES['photo']['name']);

$uploadFile = $uploadDir . $basename;

$updater = new Controller();

echo '<pre>';
if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo 'ошибка';
}
echo '</pre>';

$updater->updateAdditionalInfo($data, $uploadFile, $basename);

