<?php

use App\Controllers\ClientController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

$router->get("/", [HomeController::class, "index"]);

$router->get("/login", [LoginController::class, "index"]);
$router->post("/login", [LoginController::class, "store"]);
$router->delete("/logout", [LoginController::class, "logout"]);

$router->get("/register", [RegisterController::class, "index"])->middleware("auth:Admin");

//$router->post("/service-details", [ClientController::class, "serviceDetails"]);
$router->get("/service-details", [ClientController::class, "serviceDetails"]);
