<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\StatusLoggingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\DecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorInterface
    {
        return clone $this->getKojoApiWorkerServiceStatusLoggingDecorator();
    }
}
