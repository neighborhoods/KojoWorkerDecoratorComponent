<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): WorkerInterface
    {
        return clone $this->getWorker();
    }
}
