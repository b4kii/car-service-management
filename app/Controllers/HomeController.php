<?php

namespace App\Controllers;

use App\Core\Twig\Twig;
use App\Models\HomeModel;

class HomeController
{
    public function __construct(
        public readonly Twig      $twig,
        public readonly HomeModel $model
    )
    {
    }
    
    public function index(): string
    {
        return $this->twig->render('home/index.html.twig', [
        ]);
    }
    
    public function availableServices()
    {
        return $this->twig->render('home/avaiable-services.html.twig', [
        ]);
    }
    
    public function serviceRegulations()
    {
        return $this->twig->render('home/regulations.html.twig', [
        ]);
    }
}