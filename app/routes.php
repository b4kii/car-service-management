<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;

$router->get("/", [HomeController::class, "index"]);

$router->post("/code", [HomeController::class, "store"]);

$router->get("/login", [LoginController::class, "index"])->middleware("auth:admin,manager");

$router->get("/register", [RegisterController::class, "index"]);

