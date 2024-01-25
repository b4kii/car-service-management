<?php

namespace App\Controllers;

use App\Core\Twig\Twig;

class RegisterController
{
    public function __construct(public readonly Twig $twig)
    {
    }

    public function index(): string
    {
        return $this->twig->render('register/index.html.twig');
    }
}