<?php

namespace App\Core\Middleware;

class AuthMiddleware
{
    public function handle(array $options = []): void
    {
        //TODO: Add either redirection to unauthorized or flash message
        
        if (!isset($_SESSION["user"])) {
            header("location: /");
            exit();
        }
        
        if (!in_array($_SESSION["user"]["role"], $options)) {
            header("location: /");
            exit();
        }
        
    }
}