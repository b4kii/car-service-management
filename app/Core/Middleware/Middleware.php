<?php

namespace App\Core\Middleware;

class Middleware
{
    const MAP = [
        "guest" => GuestMiddleware::class,
        "auth" => AuthMiddleware::class,
    ];
    
    public static function resolve($key)
    {
        if (!$key) {
            return;
        }
        
        $middleware = static::MAP[$key] ?? false;
        if (!$middleware) {
            throw new \Exception("No matching middleware found for {$key}");
        }
        
        (new $middleware)->handle();
    }
}