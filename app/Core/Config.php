<?php

namespace App\Core;

class Config
{
    protected array $config = [];
    
    public function __construct()
    {
        $this->config = [
            "db" => [
                "host" => $_ENV["DB_HOST"],
                "port" => $_ENV["DB_PORT"],
                "dbname" => $_ENV["DB_NAME"],
                "charset" => $_ENV["DB_CHARSET"],
                "username" => $_ENV["DB_USERNAME"],
                "password" => $_ENV["DB_PASSWORD"]
            ]
        ];
    }
    
    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}