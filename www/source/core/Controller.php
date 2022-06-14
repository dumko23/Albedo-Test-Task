<?php

namespace App\core;

class Controller
{
    public function main(): string
    {
        return  'source/view/pages/main.php';
    }

    public function members(): string
    {
        return  'source/view/pages/members.php';
    }

    public function getMembersCount(): string
    {
        return 'source/view/handlers/membersCount.php';
    }

    public function get404(): string
    {
        return  'source/view/pages/_404.php';
    }
}