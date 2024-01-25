<?php

use App\Controllers\AdminController;
use App\Controllers\ClientController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Controllers\ServiceController;
use App\Controllers\WorkerController;

# region home controller
$router->get("/", [HomeController::class, "index"]);
# endregion

# region login controller
$router->get("/login", [LoginController::class, "index"]);
$router->post("/login", [LoginController::class, "store"]);
# endregion

# region register controller
$router->get("/register", [RegisterController::class, "index"]);
# endregion

# region client controller
$router->post("/service-details", [ClientController::class, "serviceDetails"]);
# endregion

# region worker controller
$router->get("/add-client", [WorkerController::class, "addClientIndex"]);
$router->post("/add-client", [WorkerController::class, "addClient"]);
$router->get("/add-car", [WorkerController::class, "addCarIndex"]);
$router->post("/add-car", [WorkerController::class, "addCar"]);
    // /update-client?id={id}
$router->get("/update-client", [WorkerController::class, "updateClientIndex"]);
$router->post("/update-client", [WorkerController::class, "updateClient"]);
    // /update-car?id={id}
$router->get("/update-car", [WorkerController::class, "updateCarIndex"]);
$router->post("/update-car", [WorkerController::class, "updateCar"]);
# endregion

# region service controller
    // /add-service?carId={carId}
$router->get("/add-service", [ServiceController::class, "addServiceIndex"]);
$router->post("/add-service", [ServiceController::class, "addService"]);
    // /update-service?id={id}
$router->get("/update-service", [ServiceController::class, "updateServiceIndex"]);
$router->post("/update-service", [ServiceController::class, "updateService"]);
# endregion

# region admin controller
$router->get("/add-worker", [AdminController::class, "addWorkerIndex"]);
$router->post("/add-worker", [AdminController::class, "addWorker"]);
    // /update-worker?id={id}
$router->get("/update-worker", [AdminController::class, "updateWorkerIndex"]);
$router->post("/update-worker", [AdminController::class, "updateWorker"]);
# endregion
