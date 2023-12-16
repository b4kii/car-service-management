<?php

namespace App\Controllers;

use App\Core\Twig\Twig;
use Valitron\Validator;

class LoginController
{
    public function __construct(
        public readonly Twig $twig,
        public readonly Validator $validator
    )
    {
    }
    
    public function index(): string
    {
        return $this->twig->render('login/index.html.twig');
    }
    
    public function store(): void
    {
        ["username" => $username, "password" => $password] = $_POST;
        
        redirect("/login");
    }
}