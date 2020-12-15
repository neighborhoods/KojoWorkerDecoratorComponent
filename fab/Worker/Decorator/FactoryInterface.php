<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;

interface FactoryInterface
{
    public function create(): DecoratorInterface;
}
