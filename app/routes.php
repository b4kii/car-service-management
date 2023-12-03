<?php

use App\Controllers\HomeBaseController;
use App\Controllers\LoginBaseController;
use App\Controllers\Register;

$router->get("/", [HomeBaseController::class, "index"]);

$router->get("/login", [LoginBaseController::class, "index"])->middleware("auth:admin,manager");

$router->get("/register", [Register::class, "index"]);

