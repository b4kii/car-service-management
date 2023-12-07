<?php

namespace App\Controllers;

use App\Core\Twig\Twig;
use App\Models\TestModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        return $this->twig->render('home/index.html.twig', [
        ]);
    }
}