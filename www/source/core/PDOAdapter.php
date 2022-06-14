<?php

namespace App\core;

use PDO;

class PDOAdapter
{
    private static PDO $db;


    protected static function connection($config): PDO
    {
        if (!isset(self::$db)) {
            self::$db = new PDO($config['name'] . 'dbname:' . $config['db'],
                $config['user'], $config['password'], $config['options']);
        }
        return self::$db;
    }

}