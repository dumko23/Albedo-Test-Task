<?php

use App\core\Application;
$config = require('source/config.php');
$memberCount = new Application();
$members = $memberCount->model->membersCount($config);
echo $members;