<?php

namespace App;

use Exception;
use PDO;

class PDOAdapter
{
    private static PDO $db;
    private const HOST = 'mysql';
    private const DB_NAME = 'MemberList';

    private function __construct()
    {
    }

    protected function __clone(): void
    {
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function db(): PDO
    {
        if (!isset(self::$db)) {
            self::$db = new PDO('mysql:host=' . self::HOST . ';port:3306dbname:' . self::DB_NAME,
                'root', 'password', [
                    PDO::ATTR_DEFAULT_FETCH_MODE => 2
                ]);
        }
        return self::$db;
    }

    public static function insertToDB(string $firstName, string $lastName, int $date, string $subject, string $country, string $phone, string $email): void
    {
        static::db()->prepare('insert into MemberList.Members 
    (firstName, lastName, date, subject, country, phone, email)
                                values (?, ?, ?, ?, ?, ?, ?)')->execute([$firstName, $lastName, $date, $subject, $country, $phone, $email]);
    }

    public static function getFromDB(): bool|array
    {
        $queryGet = 'select photo, firstName, lastName, email from MemberList.Members;';
        return static::db()->query($queryGet)->fetchAll();
    }

    public static function deleteFromDB(): string
    {
        return "delete from MemberList.Members";
    }


}