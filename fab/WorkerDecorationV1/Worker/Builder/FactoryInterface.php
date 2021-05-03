<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}
