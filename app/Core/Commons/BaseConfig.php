<?php

namespace App\Core\Commons;

class BaseConfig
{
    protected array $config = [];
    
    public function getConfig(): array|string
    {
        return $this->config;
    }
}