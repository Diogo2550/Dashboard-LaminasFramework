<?php

declare(strict_types=1);

namespace Core;

use Laminas\Db\Adapter\Adapter;
use Laminas\EventManager\EventInterface;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }
}
