<?php

namespace App\Models;

use App\Core\Database;

class Model
{
    public function __construct(public readonly Database $db)
    {
    }
}