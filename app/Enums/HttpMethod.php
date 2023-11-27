<?php

namespace App\Enums;

enum HttpMethod: string
{
    case Post = "POST";
    case Get = "GET";
    case Put = "PUT";
    case Patch = "PATCH";
    case Delete = "DELETE";
}