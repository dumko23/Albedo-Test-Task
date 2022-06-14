<?php

namespace App\core;

class Controller extends Model
{
    public function main(): string
    {
        return  'source/view/main.php';
    }

    public function members(): string
    {
        return  'source/view/members.php';
    }

    public function getMembersCount(): string
    {
        return 'source/view/membersCount.php';
    }

    public function get404(): string
    {
        return  'source/view/_404.php';
    }


}