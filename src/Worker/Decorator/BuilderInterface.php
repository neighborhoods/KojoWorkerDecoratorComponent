<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface BuilderInterface
{
    public function build(): DecoratorInterface;

    public function setWorker(WorkerInterface $worker);
}
