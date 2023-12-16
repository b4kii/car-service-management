<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use Valitron\Validator;

class LoginController
{
    public function __construct(
        public readonly Twig $twig
//        public readonly Validator $validator
    )
    {
    }
    
    public function index(): string
    {
        return $this->twig->render('login/index.html.twig');
    }
    
    public function store(): string
    {
        $validator = new Validator($_POST);
        $validator->rule("required", ["username", "password"]);
        $validator->rule('lengthBetween', 'username', 3, 10);
        
        if (!$validator->validate()) {
            Session::flash("errors", [
                "username" => $validator->errors("username"),
                "password" => $validator->errors("password")
            ]);
            
            Session::flash("old", ["username" => $_POST["username"]]);
            
            redirect("/login");
        }
        
        return "test";
    }
}