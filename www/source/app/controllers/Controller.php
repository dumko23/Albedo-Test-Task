<?php

namespace App\app\controllers;

class Controller
{
    public function main(): string
    {
        return  'source/app/views/view/pages/main.php';
    }

    public function members(): string
    {
        return  'source/app/views/view/pages/members.php';
    }

    public function getMembersCount(): string
    {
        return 'source/app/views/view/handlers/membersCount.php';
    }

    public function get404(): string
    {
        return  'source/app/views/view/pages/_404.php';
    }
}