<?php

declare(strict_types=1);

session_start();

use App\Core\App;
use App\Core\Router;
use App\Core\Session;

const BASE_PATH = __DIR__ . "/../";

require_once BASE_PATH . "vendor/autoload.php";

require_once BASE_PATH . "app/helpers/functions.php";

//set_exception_handler(fn(Throwable $e) => var_dump($e->getMessage()));

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

Session::unflash();
