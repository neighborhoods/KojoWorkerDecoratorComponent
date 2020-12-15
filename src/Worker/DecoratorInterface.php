<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface DecoratorInterface extends WorkerInterface
{
    public function setWorker(WorkerInterface $Worker);
}
