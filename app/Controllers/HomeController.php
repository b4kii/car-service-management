<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index(): string
    {
        return $this->twig->render('home.html.twig');
    }
}