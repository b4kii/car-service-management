<?php

use App\Controllers\ClientController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

$router->get("/", [HomeController::class, "index"]);


$router->get("/login", [LoginController::class, "index"])->middleware("auth:admin,manager");

$router->get("/register", [RegisterController::class, "index"]);

$router->post("/service-details", [ClientController::class, "serviceDetails"]);
