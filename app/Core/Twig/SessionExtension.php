<?php

namespace App\Core\Twig;

use App\Core\Commons\Session;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

class SessionExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            "session" => $_SESSION
        ];
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('get', [$this, 'getSession'])
        ];
    }
    
    public function getSession(string $key)
    {
        return Session::get($key);
    }
}