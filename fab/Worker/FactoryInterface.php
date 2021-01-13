<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface FactoryInterface
{
    public function create(): WorkerInterface;
}
