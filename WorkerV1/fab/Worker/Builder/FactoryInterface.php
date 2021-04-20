<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
