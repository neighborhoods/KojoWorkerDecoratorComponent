<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder();
    }
}
