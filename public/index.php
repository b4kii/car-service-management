<?php

declare(strict_types=1);

session_start();

use App\App;
use App\Core\Commons\Router;
use App\Core\Commons\Session;

const BASE_PATH = __DIR__ . "/../";

require_once BASE_PATH . "vendor/autoload.php";

require_once BASE_PATH . "app/helpers/functions.php";

// Catch other errors
set_exception_handler(fn(Throwable $e) => var_dump([$e->getMessage(), $e->getFile(), $e->getLine()]));

$container = new Illuminate\Container\Container();
$router = new Router($container);

require_once base_path("app/routes.php");

(new App(
    $container,
    $router,
    [
        "uri" => $uri = parse_url($_SERVER["REQUEST_URI"])["path"],
        "method" => $method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"]
    ]
))
    ->boot()
    ->run();

