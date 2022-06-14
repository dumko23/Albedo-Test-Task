<?php

$router->get('', 'controller@main');
$router->get('members', 'controller@members');
$router->get('get', 'controller@getMembersCount');
$router->post('send', 'source/controllers/handlerSend.php');
$router->post('update', 'source/controllers/handlerUpdate.php');