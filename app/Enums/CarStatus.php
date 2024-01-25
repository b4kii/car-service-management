<?php

namespace App\Enums;

enum CarStatus: string
{
    case New = "New";
    case InProgress = "InProgress";
    case Cancelled = "Cancelled";
    case Finshed = "Finished";
}
