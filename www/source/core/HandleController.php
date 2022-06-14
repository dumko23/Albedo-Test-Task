<?php

namespace App\core;

class HandleController
{
    public function send(): string
    {
        return 'source/view/handlers/handlerSend.php';
    }

    public function update(): string
    {
        return 'source/view/handlers/handlerUpdate.php';
    }
}