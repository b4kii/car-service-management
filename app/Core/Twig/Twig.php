<?php

namespace App\Core\Twig;

use Twig\Environment;
use Twig\Loader\LoaderInterface;

class Twig extends Environment
{
    public function __construct(LoaderInterface $loader, $options = [])
    {
        parent::__construct($loader, $options);
    }
}