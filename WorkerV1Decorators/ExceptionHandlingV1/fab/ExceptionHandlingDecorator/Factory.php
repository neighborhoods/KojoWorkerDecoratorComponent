<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ExceptionHandlingDecoratorInterface
    {
        return clone $this->getExceptionHandlingDecorator();
    }
}
