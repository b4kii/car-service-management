<?php

namespace App\Core;

class Config
{
    protected array $config = [];
    
    public function __construct()
    {
        $this->config = [
            "db" => [
                "host" => "localhost",
                "port" => 3306,
                "dbname" => "db",
                "charset" => "utf8mb4"
            ]
        ];
    }
    
    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}