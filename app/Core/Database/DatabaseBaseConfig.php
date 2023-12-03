<?php

namespace App\Core\Database;

class DatabaseBaseConfig extends BaseConfig
{
    public function __construct()
    {
        $this->config = [
            "host" => $_ENV["CAR_SERVICE_DB_HOST"],
            "port" => $_ENV["CAR_SERVICE_DB_PORT"],
            "dbname" => $_ENV["CAR_SERVICE_DB_NAME"],
            "username" => $_ENV["CAR_SERVICE_USERNAME"],
            "password" => $_ENV["CAR_SERVICE_PASSWORD"],
            "charset" => "utf8mb4"
        ];
    }
}