<?php

namespace App;

use App\core\Application;

require  './vendor/autoload.php';

$data = $_POST['data'];

$uploadDir = 'uploads/';
$basename = basename($_FILES['photo']['name']);
$uploadFile ='source/' . $uploadDir . $basename;

$app = new Application();


echo '<pre>';
if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo 'ошибка';
}
echo '</pre>';

$app->controller->updateAdditionalInfo($app->getConfig(), $data, $uploadFile, $basename);

