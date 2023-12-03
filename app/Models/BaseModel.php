<?php

namespace App\Models;

use App\Core\Database;

class BaseModel
{
    public function __construct(public readonly Database\DatabaseConnection $databaseConnection)
    {
    }
}