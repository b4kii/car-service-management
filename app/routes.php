<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\Register;

$router->get("/", [HomeController::class, "index"]);

$router->get("/login", [LoginController::class, "index"])->middleware("auth:admin,manager");

$router->get("/register", [Register::class, "index"]);
