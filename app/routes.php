<?php

use App\Controllers\ClientController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\WorkerController;

// home controller
$router->get("/", [HomeController::class, "index"]);

// login controller
$router->get("/login", [LoginController::class, "index"]);
$router->post("/login", [LoginController::class, "store"]);
$router->delete("/logout", [LoginController::class, "logout"]);

// register controller
$router->get("/register", [RegisterController::class, "index"]);

$router->post("/service-details", [ClientController::class, "serviceDetails"]);

// worker controller
$router->get("/add-client", [WorkerController::class, "addClientIndex"]);
$router->post("/add-client", [WorkerController::class, "addClient"]);
$router->get("/add-car", [WorkerController::class, "addCarIndex"]);
$router->post("/add-car", [WorkerController::class, "addCar"]);
