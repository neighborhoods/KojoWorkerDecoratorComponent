<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

interface DecoratorInterface extends WorkerInterface
{
    public function setWorkerDecorationV1Worker(WorkerInterface $Worker);
}
