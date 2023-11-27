<?php
declare(strict_types=1);

use App\Controllers\HomeController;

$router->get("/", [HomeController::class, "index"])->middleware("guest");
$router->get("/show", [HomeController::class, "show"])->middleware("guest");
