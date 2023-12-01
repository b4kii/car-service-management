<?php

namespace App\Core\Database;

class DatabaseConfig
{
    protected array $config = [];
    
    public function __construct()
    {
        $this->config = [
            "db" => [
                "host" => $_ENV["CAR_SERVICE_DB_HOST"],
                "port" => $_ENV["CAR_SERVICE_DB_PORT"],
                "dbname" => $_ENV["CAR_SERVICE_DB_NAME"],
                "username" => $_ENV["CAR_SERVICE_USERNAME"],
                "password" => $_ENV["CAR_SERVICE_PASSWORD"],
                "charset" => "utf8mb4"
            ]
        ];
    }
    
    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}