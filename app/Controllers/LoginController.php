<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use App\Models\LoginModel;
use Valitron\Validator;

class LoginController
{
    public function __construct(
        public readonly Twig $twig,
        public readonly LoginModel $model
    )
    {
    
    }
    
    public function index(): string
    {
        return $this->twig->render('login/index.html.twig');
    }
    
    public function store(): string
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $validator = new Validator($_POST);
        $validator->rule("required", ["username", "password"])->message("Pole '{field}' jest wymagane");
        $validator->labels([
            "username" => "Nazwa użytkownika",
            "password" => "Hasło"
        ]);
        $validator->rule(function ($field, $value, $params, $fields) use ($username, $password) {
            return $this->model->verifyUser($username, $password);
        }, ["username", "password"])
            ->message("Niepoprawna nazwa użytkownika lub hasło");
        
        
        if (!$validator->validate()) {
            Session::flash("errors", [
                "username" => $validator->errors("username"),
                "password" => $validator->errors("password")
            ]);
            
            Session::flash("old", ["username" => $username]);
            redirect("/login");
        }
        
        $this->model->loginUser($username);
        
        redirect("/register");
    }
    
    public function logout(): void
    {
        Session::destroy("user");
        redirect("/");
    }
}