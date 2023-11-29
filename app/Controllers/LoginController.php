<?php

namespace App\Controllers;

class LoginController extends Controller
{
    public function index(): string
    {
        return $this->twig->render('login/index.html.twig');
    }
}