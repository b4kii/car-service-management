<?php

namespace App\Core\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class SessionExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            "session" => $_SESSION
        ];
    }
}