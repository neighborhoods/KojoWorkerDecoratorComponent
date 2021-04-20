<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

interface DecoratorInterface extends WorkerInterface
{
    public function setWorker(WorkerInterface $Worker);
}
