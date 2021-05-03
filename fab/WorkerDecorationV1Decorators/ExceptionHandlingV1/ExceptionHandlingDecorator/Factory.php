<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ExceptionHandlingDecoratorInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator();
    }
}
