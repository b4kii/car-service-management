<?php

namespace App\Controllers;

use App\Core\Twig\Twig;

class Controller
{
    public function __construct(public readonly Twig $twig)
    {
    }
}