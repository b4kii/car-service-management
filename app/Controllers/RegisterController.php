<?php

namespace App\Controllers;

class RegisterController extends BaseController
{
    public function index(): string
    {
        return $this->twig->render('register/index.html.twig');
    }
}