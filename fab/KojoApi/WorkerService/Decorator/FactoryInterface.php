<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\Decorator;

use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\DecoratorInterface;

interface FactoryInterface
{
    public function create(): DecoratorInterface;
}
