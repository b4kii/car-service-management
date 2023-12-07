<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    public function serviceDetails(): string
    {
        $customerCode = $_POST["customerCode"];
        $cars = ["one", "two", "three"];
        return $this->twig->render("customer/service-details.html.twig", [
            "customerCode" => $customerCode,
            "cars" => $cars
        ]);
    }
}