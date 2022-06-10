<?php

namespace App\source\controllers;

use PDO;

return [
    'database' => [
        'user' => 'root',
        'password' => 'password',
        'name' => 'mysql:host=mysql;port:3306;',
        'db' => 'MemberList',
        'options' => [
            PDO::ATTR_DEFAULT_FETCH_MODE => 2
        ]
    ],
    'shareMessage' => [
        'message' => 'Check out this Meetup with SoCal AngularJS!'
    ],
    'routes' => [
        '' => 'source/controllers/main.php',
        'members' => 'source/controllers/members.php',
        'send' => 'source/controllers/handlerSend.php',
        'update' => 'source/controllers/handlerUpdate.php',
        'get' => 'source/controllers/getMembersCount.php'
    ]
];