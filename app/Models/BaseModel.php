<?php

namespace App\Models;

use App\Core\Database\Database;
use App\Traits\BaseModelTrait;

class BaseModel
{
    use BaseModelTrait;
    public function __construct(public readonly Database $database)
    {
    }
}