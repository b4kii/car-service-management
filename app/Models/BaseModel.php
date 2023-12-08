<?php

namespace App\Models;

use App\Core\Database;
use App\Traits\BaseModelTrait;

class BaseModel
{
    use BaseModelTrait;
    public function __construct(public readonly Database\DatabaseConnection $databaseConnection)
    {
    }
}