<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

interface FactoryInterface
{
    public function create(): WorkerInterface;
}
