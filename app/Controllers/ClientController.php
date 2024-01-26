<?php

namespace App\Controllers;

use App\Core\Commons\Session;
use App\Core\Twig\Twig;
use App\Models\ClientModel;
use Valitron\Validator;

class ClientController
{
    public function __construct(
        public readonly Twig $twig,
        public readonly ClientModel $model
    )
    {
    }
    
    public function serviceDetails(): string
    {
        $clientCode = $_GET["clientCode"];
        
        $validator = new Validator($_GET);
        $validator->rule("required", "clientCode")
            ->message("Pole '{field}' jest wymagane")
            ->label("Kod klienta");
        
        $validator->rule(function ($field, $value, $params, $fields) use ($clientCode) {
            return $this->model->verifyCode($clientCode);
        }, ["clientCode"])
            ->message("Niepoprawny kod klienta");
        
        if (!$validator->validate()) {
            Session::flash("errors", [
                "clientCode" => $validator->errors("clientCode")
            ]);

            Session::flash("old", ["clientCode" => $clientCode]);
            redirect("/");
        }
        
        $cars = $this->model->getClientServiceDetails($clientCode);
        $client = $this->model->getClientDetails($clientCode);
        
        return $this->twig->render("client/service-details.html.twig", [
            "clientCode" => $clientCode,
            "cars" => $cars,
            "client" => $client
        ]);
    }
}