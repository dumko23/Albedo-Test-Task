<?php

use App\core\Application;

$app = new Application();
$members = $app->model->membersCount($app->getConfig());
echo $members;