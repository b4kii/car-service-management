<?php

namespace App\Core\Middleware;

class AuthMiddleware
{
    public function handle(array $options = []): void
    {
        if (
            !isset($_SESSION["user"]) ||
            (!in_array($_SESSION["user"]["role"], $options) && !in_array("All", $options))
        ) {
            header("location: /");
            exit();
        }
        
    }
}