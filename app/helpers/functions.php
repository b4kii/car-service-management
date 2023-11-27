<?php

use App\Core\Session;

function dd($value): never
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    exit();
}

function checkUri($uri): string
{
    return $_SERVER["REQUEST_URI"] == $uri;
}

function authorize($condition): void
{
    if (!$condition) {
        abort(403);
    }
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
    require_once base_path("templates/{$code}.html.twig");
    exit();
}

function redirect($path): never
{
    header("location: {$path}");
    exit();
}

function old($key, $default = ""): Session
{
    return Session::get("old")[$key] ?? $default;
}
