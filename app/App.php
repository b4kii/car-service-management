<?php

//TODO: Add validator, improve middleware

namespace App;

use App\Core\Commons\BaseConfig;
use App\Core\Commons\Router;
use App\Core\Database\DatabaseConfig;
use App\Core\Database\DatabaseConnection;
use App\Core\Database\DatabaseSeed;
use App\Core\Database\Interfaces\DatabaseConnectionInterface;
use App\Core\Interfaces\BaseConfigInterface;
use App\Core\Twig\SessionExtension;
use App\Core\Twig\Twig;
use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;

class App
{
    protected static DatabaseConnection $db;
    private DatabaseSeed $seedData;
    
    public function __construct(protected \Illuminate\Container\Container $container, protected Router $router, protected array $request)
    {
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

        // base classes
        $this->container->scoped(BaseConfigInterface::class, BaseConfig::class);

        $config = new DatabaseConfig();
        $db = new DatabaseConnection($config->getConfig());
        
        $this->container->singleton(Twig::class, fn() => $twig);
        $this->container->singleton(DatabaseConnection::class, fn() => $db);
        $this->container->scoped(DatabaseConnectionInterface::class, DatabaseConnection::class);

        $seedData = $this->container->get(DatabaseSeed::class);
        $seedData->seedData();
        
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