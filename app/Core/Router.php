<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Middleware\Middleware;
use App\Enums\HttpMethod;

class Router
{
     protected array $routes = [];
    
    public function __construct(protected \Illuminate\Container\Container $container)
    {
    }
    
    public function add(HttpMethod $method, string $uri, array|callable $controller): self
    {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "middleware" => null
        ];
        
        return $this;
    }
    
    public function get(string $uri, array|callable $controller): self
    {
        return $this->add(HttpMethod::Get, $uri, $controller);
    }
    public function post(string $uri, array|callable $controller): self
    {
        return $this->add(HttpMethod::Post, $uri, $controller);
    }
    
    public function delete(string $uri, array|callable $controller): self
    {
        return $this->add(HttpMethod::Delete, $uri, $controller);
    }
    
    public function put(string $uri, array|callable $controller): self
    {
        return $this->add(HttpMethod::Put, $uri, $controller);
    }
    
    public function patch(string $uri, array|callable $controller): self
    {
        return $this->add(HttpMethod::Patch, $uri, $controller);
    }
    
    public function middleware(string $key): self
    {
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;
        return $this;
    }
    
    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"]->value === strtoupper($method)) {
                Middleware::resolve($route["middleware"]);
                
                if (is_callable($route["controller"])) {
                    call_user_func($route["controller"]);
                    exit;
                }
                
                [$controller, $action] = $route["controller"];
                
                if (class_exists($controller)) {
                    $controller = $this->container->get($controller);
                    
                    if (method_exists($controller, $action)) {
                        echo call_user_func_array([$controller, $action], []);
                        exit;
                    }
                }
            }
        }
        
        $this->abort();
    }
    
    public function abort($code = 404): never
    {
        require_once base_path("templates/errors/{$code}.html.twig");
        exit();
    }
}