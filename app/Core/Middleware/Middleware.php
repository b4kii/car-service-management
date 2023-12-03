<?php

namespace App\Core\Middleware;

class Middleware
{
    const MAP = [
        "auth" => AuthMiddleware::class
    ];
    
    public static function resolve($key)
    {
        if (!$key) {
            return;
        }
        
        $options = [];
        
        if (str_contains($key, ":")) {
            $dest = explode(":",  $key);
            $key = $dest[0];
            $options = explode(",", $dest[1]);
        }

        $middleware = static::MAP[$key] ?? false;
        
        if (!$middleware) {
            throw new \Exception("No matching middleware found for {$key}");
        }

        (new $middleware)->handle($options);
    }
}