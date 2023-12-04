<?php

namespace App\Core\Interfaces;

interface BaseConfigInterface
{
    function getConfig() : array|string;
}