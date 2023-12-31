<?php

namespace App\Controllers;

class ClientController extends BaseController
{
    public function serviceDetails(): string
    {
//        $clientCode = $_POST["clientCode"];
        $clientCode = $_GET["clientCode"];
        $cars = [
            ["model" => "Audi"],
            ["model" => "BMW"],
            ["model" => "Volkswagen"]
        ];
        
        return $this->twig->render("client/service-details.html.twig", [
            "clientCode" => $clientCode,
            "cars" => $cars
        ]);
    }
}