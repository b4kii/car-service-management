<?php

use App\Core\Commons\Session;

function dd($value): never
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    exit();
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function render($path, $data = []): void
{
    extract($data);
    require_once base_path("templates/" . $path);
}

function abort($code = 404): never
{
    require_once base_path("templates/errors/{$code}.html.twig");
    exit();
}

function redirect($path, $param = ""): never
{
    header("location: {$path}{$param}");
    exit();
}

function old($key, $default = ""): Session
{
    return Session::get("old")[$key] ?? $default;
}
