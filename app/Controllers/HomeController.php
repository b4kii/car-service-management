<?php

namespace App\Controllers;

use App\Core\Database\Interfaces\DatabaseConnectionInterface;
use App\Core\Twig\Twig;
use App\Models\HomeModel;

class HomeController
{
    public function __construct(
        public readonly Twig $twig,
        public readonly HomeModel $model
    )
    {
    }
    
    public function index(): string
    {
//        dd($this->model->getAll());
        
        return $this->twig->render('home/index.html.twig', [
        ]);
    }
}