<?php

namespace App;

use PDO;

class PDOAdapter
{
    private static PDO $db;
    private const HOST = 'mysql';
    private const DB_NAME = 'MemberList';

    protected function connection(): PDO
    {
        if (!isset(self::$db)) {
            self::$db = new PDO('mysql:host=' . self::HOST . ';port:3306dbname:' . self::DB_NAME,
                'root', 'password', [
                    PDO::ATTR_DEFAULT_FETCH_MODE => 2
                ]);
        }
        return self::$db;
    }

    /*protected function insertMemberToDB(string $firstName, string $lastName, string $date, string $subject, string $country, string $phone, string $email): void
    {
        $this->connection()->prepare('insert into MemberList.Members
    (firstName, lastName, date, subject, country, phone, email)
                                values (?, ?, ?, ?, ?, ?, ?)')->execute([$firstName, $lastName, $date, $subject, $country, serialize($phone), $email]);
    }

    protected function getMembersFromDB(): bool|array
    {
        $queryGet = 'select photo, firstName, lastName, email, subject from MemberList.Members;';
        return $this->connection()->query($queryGet)->fetchAll();
    }

    protected function searchMember($email): bool|array
    {
         $querySearch = "select  memberId from MemberList.Members where email = '$email';";
        return $this->connection()->query($querySearch)->fetchAll();
    }

    protected function update($memberId, $company, $position, $about, $photo): void
    {
        $this->connection()->prepare("update MemberList.Members set company = ?, position = ?, about = ?, photo = ?   where memberId = ?")
            ->execute([$company, $position, $about, $photo, $memberId]);
    }*/


}