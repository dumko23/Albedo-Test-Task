<?php

$router->get('', 'source/controllers/main.php');
$router->get('members', 'source/controllers/members.php');
$router->get('get', 'source/controllers/getMembersCount.php');
$router->post('send', 'source/controllers/handlerSend.php');
$router->post('update', 'source/controllers/handlerUpdate.php');