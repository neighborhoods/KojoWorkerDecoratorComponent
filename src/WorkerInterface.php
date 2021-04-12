<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent;

interface WorkerInterface
{
    public function work(): WorkerInterface;
}
