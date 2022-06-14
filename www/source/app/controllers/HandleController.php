<?php

namespace App\app\controllers;

class HandleController
{
    public function send(): string
    {
        return 'source/app/views/view/handlers/handlerSend.php';
    }

    public function update(): string
    {
        return 'source/app/views/view/handlers/handlerUpdate.php';
    }
}