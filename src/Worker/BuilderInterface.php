<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface BuilderInterface
{
    public function build(): WorkerInterface;

    public function setWorkerFactory(FactoryInterface $workerFactory);
    public function addDecoratorBuilderFactory(
        Decorator\Builder\FactoryInterface $decoratorBuilderFactory
    ): BuilderInterface;
}
