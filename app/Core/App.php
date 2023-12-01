<?php

//TODO: Add validator, improve middleware

namespace App\Core;

use App\Core\Database\DatabaseConnection;
use App\Core\Database\DatabaseConfig;
use App\Core\Database\DatabaseSeedData;
use App\Core\Twig\SessionExtension;
use App\Core\Twig\Twig;
use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;

class App
{
    protected static DatabaseConnection $db;
    private DatabaseConfig $config;
    private DatabaseSeedData $seedData;
    
    public function __construct(protected \Illuminate\Container\Container $container, protected Router $router, protected array $request)
    {
//        $this->container->set(interface, class);
    }
    
    public static function db(): DatabaseConnection
    {
        return static::$db;
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
        
        $this->config = new DatabaseConfig();
        $db = new DatabaseConnection($this->config->db);
        $this->seedData = new DatabaseSeedData($db);
        $this->seedData->seedData();
        
        $this->container->singleton(Twig::class, fn() => $twig);
        $this->container->singleton(DatabaseConnection::class, fn() => $db);
        
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