<?php

namespace App;

$data = $_POST["data"];


$result = $app->model->registerNewMember($app->getConfig(), $data);


echo $result;
