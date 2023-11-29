<?php

namespace App\Controllers;

class Register extends Controller
{
    public function index(): string
    {
        return $this->twig->render('register/index.html.twig');
    }
}