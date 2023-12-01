<?php

//TODO: Add validator, improve middleware

namespace App\Core;

use App\Core\Twig\SessionExtension;
use App\Core\Twig\Twig;
use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;

class App
{
    protected static Database $db;
    private Config $config;
    
    public function __construct(protected \Illuminate\Container\Container $container, protected Router $router, protected array $request)
    {
//        $this->container->set(interface, class);
    }
    
    public function boot(): static
    {
        
        $dotenv = Dotenv::createImmutable(BASE_PATH);
        $dotenv->load();
        
        $loader = new FilesystemLoader(base_path("templates"));
        $twig = new Twig($loader, [
            'cache' => BASE_PATH . 'storage/cache',
            'auto_reload' => true
        ]);
        $twig->addExtension(new SessionExtension());
        
        $this->config = new Config();
        $db = new Database($this->config->db);
        
        $this->container->singleton(Twig::class, fn() => $twig);
        $this->container->singleton(Database::class, fn() => $db);
        
        return $this;
    }
    
    public function run(): void
    {
        $this->router
            ->route(
            $this->request["uri"],
            $this->request["method"]
        );
    }
}