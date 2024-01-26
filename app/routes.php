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

$router->get("/service-details", [ClientController::class, "serviceDetails"]);

// worker controller
$router->get("/add-client", [WorkerController::class, "addClientIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/add-client", [WorkerController::class, "addClient"])->middleware("auth:Admin,Manager,Worker");
$router->get("/add-car", [WorkerController::class, "addCarIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/add-car", [WorkerController::class, "addCar"])->middleware("auth:Admin,Manager,Worker");
$router->get("/worker-cars", [WorkerController::class, "carListIndex"])->middleware("auth:Admin,Manager,Worker");

// profile
$router->get("/profile", [WorkerController::class, "profileIndex"])->middleware("auth:Admin,Manager,Worker");
$router->get("/profile-edit", [WorkerController::class, "editProfileIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/profile-edit", [WorkerController::class, "editProfile"])->middleware("auth:Admin,Manager,Worker");

//TODO:
//    endpointy z middlewarami edit worker add worker admin
//    readme
//    spiac nowe endpointy
//    spiac caly projekt
