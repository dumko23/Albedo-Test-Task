<?php

namespace App;

use App\core\Application;

require __DIR__ . '/../vendor/autoload.php';

$data = $_POST['data'];

$uploadDir = './uploads/';
$basename = basename($_FILES['photo']['name']);
$uploadFile = $uploadDir . $basename;

$updater = new Application();

$config = require('source/config.php');

echo '<pre>';
if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo 'ошибка';
}
echo '</pre>';

$updater->controller->updateAdditionalInfo($config, $data, $uploadFile, $basename);

