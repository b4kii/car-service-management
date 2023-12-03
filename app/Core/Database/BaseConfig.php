<?php

namespace App\Core\Database;

class BaseConfig
{
    protected array $config = [];
    
    public function getConfig(): array|string
    {
        return $this->config;
    }
}