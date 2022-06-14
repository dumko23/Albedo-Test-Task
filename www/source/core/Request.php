<?php

namespace App\core;

class Request
{

    public function getUri($request): string
    {
        return trim($request, '/');
    }
}