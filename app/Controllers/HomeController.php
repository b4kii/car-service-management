<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return $this->twig->render('home/index.html.twig');
    }
}