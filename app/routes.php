<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\Register;

$router->get("/", [HomeController::class, "index"])->middleware("guest");

$router->get("/login", [LoginController::class, "index"])->middleware("guest");

$router->get("/register", [Register::class, "index"])->middleware("guest");
