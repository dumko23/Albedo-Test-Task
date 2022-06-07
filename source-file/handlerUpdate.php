<?php

namespace App;
require __DIR__ . '/../vendor/autoload.php';

$data = $_POST['data'];
$uploadDir = './uploads/';

print_r($_FILES['photo']['error']);
$uploadFile = $uploadDir . basename($_FILES['photo']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo 'ошибка';
}
echo '</pre>';

print_r($_FILES['photo']['error']);



$searchedId = PDOAdapter::searchMember($data['email'])[0]['memberId'];

if($searchedId){
    if(!$data['company']){
        $data['company'] = '';
    }
    if(!$data['position']){
        $data['position'] = '';
    }
    if(!$data['about']){
        $data['about'] = '';
    }
    if(!basename($_FILES['photo']['name'])){
        $uploadFile = '';
    }
    print_r($data);
    PDOAdapter::update($searchedId, $data['company'], $data['position'], $data['about'], $uploadFile );
}
echo "<img src='{$uploadFile}'>";
