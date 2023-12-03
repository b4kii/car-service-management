<?php

namespace App\Controllers;

class HomeBaseController extends BaseController
{
    public function index(): string
    {
        return $this->twig->render('home/index.html.twig');
    }
}