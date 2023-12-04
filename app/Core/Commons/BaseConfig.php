<?php

namespace App\Core\Commons;

use App\Core\Interfaces\BaseConfigInterface;

class BaseConfig implements BaseConfigInterface
{
    protected array $config = [];
    
    public function getConfig(): array|string
    {
        return $this->config;
    }
}