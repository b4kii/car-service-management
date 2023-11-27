<?php

namespace App\Core\Middleware;

class AuthMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION["user"])) {
            header("location: /dupa");
            exit();
        }
    }
}