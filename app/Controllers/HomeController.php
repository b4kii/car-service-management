<?php

namespace App\Controllers;

use App\Core\Twig\Twig;
use App\Models\TestModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        return $this->twig->render('home/index.html.twig');
    }
    
    public function store()
    {
        dd($this->model->getUsers());
        
        $_SESSION["test"] = $_POST["code"];
        dd($_POST["code"]);
    }
    
    public function show()
    {
        return $this->twig->render('register/index.html.twig');
    }
}