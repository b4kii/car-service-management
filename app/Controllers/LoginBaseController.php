<?php

namespace App\Controllers;

class LoginBaseController extends BaseController
{
    public function index(): string
    {
        return $this->twig->render('login/index.html.twig');
    }
}