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

//$searchedId = PDOAdapter::searchMember($data['email'])[0]['memberId'];
//
//if ($searchedId) {
//    if (!$data['company']) {
//        $data['company'] = '';
//    }
//    if (!$data['position']) {
//        $data['position'] = '';
//    }
//    if (!$data['about']) {
//        $data['about'] = '';
//    }
//    if (!basename($_FILES['photo']['name'])) {
//        $uploadFile = '';
//    }
//    PDOAdapter::update($searchedId, $data['company'], $data['position'], $data['about'], $uploadFile);
//}

