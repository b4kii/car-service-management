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
$router->get("/available-services", [HomeController::class, "availableServices"]);
$router->get("/regulations", [HomeController::class, "serviceRegulations"]);
# endregion

# region login controller
$router->get("/login", [LoginController::class, "index"]);
$router->post("/login", [LoginController::class, "store"]);

$router->delete("/logout", [LoginController::class, "logout"]);
# endregion

# region client controller
$router->post("/service-details", [ClientController::class, "serviceDetails"]);
$router->get("/service-details", [ClientController::class, "serviceDetails"]);
# endregion

# region worker controller
$router->get("/add-client", [WorkerController::class, "addClientIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/add-client", [WorkerController::class, "addClient"])->middleware("auth:Admin,Manager,Worker");
$router->get("/add-car", [WorkerController::class, "addCarIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/add-car", [WorkerController::class, "addCar"])->middleware("auth:Admin,Manager,Worker");
    // /update-client?id={id}
$router->get("/update-client", [WorkerController::class, "updateClientIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/update-client", [WorkerController::class, "updateClient"])->middleware("auth:Admin,ManagerWorker");
    // /update-car?id={id}
$router->get("/update-car", [WorkerController::class, "updateCarIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/update-car", [WorkerController::class, "updateCar"])->middleware("auth:Admin,Manager,Worker");
$router->get("/worker-cars", [WorkerController::class, "carListIndex"])->middleware("auth:Admin,Manager,Worker");
# endregion

# region service controller
    // /add-service?carId={carId}
$router->get("/add-service", [ServiceController::class, "addServiceIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/add-service", [ServiceController::class, "addService"])->middleware("auth:Admin,Manager,Worker");
    // /update-service?id={id}
$router->get("/update-service", [ServiceController::class, "updateServiceIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/update-service", [ServiceController::class, "updateService"])->middleware("auth:Admin,Manager,Worker");
$router->post("/delete-service", [ServiceController::class, "deleteService"])->middleware("auth:Admin,Manager,Worker");
# endregion

# region admin controller
$router->get("/add-worker", [AdminController::class, "addWorkerIndex"])->middleware("auth:Admin");
$router->post("/add-worker", [AdminController::class, "addWorker"])->middleware("auth:Admin");
    // /update-worker?id={id}
$router->get("/update-worker", [AdminController::class, "updateWorkerIndex"])->middleware("auth:Admin");
$router->post("/update-worker", [AdminController::class, "updateWorker"])->middleware("auth:Admin");
$router->get("/workers", [AdminController::class, "showWorkers"])->middleware("auth:Admin");
$router->get("/clients", [AdminController::class, "showClients"])->middleware("auth:Admin");
# endregion

#region profile controller
$router->get("/profile", [WorkerController::class, "profileIndex"])->middleware("auth:Admin,Manager,Worker");
$router->get("/profile-edit", [WorkerController::class, "editProfileIndex"])->middleware("auth:Admin,Manager,Worker");
$router->post("/profile-edit", [WorkerController::class, "editProfile"])->middleware("auth:Admin,Manager,Worker");
#endregion
