<?php

namespace App\Controllers;

use App\Core\Twig\Twig;

class BaseController
{
    public function __construct(public readonly Twig $twig)
    {
    }
}