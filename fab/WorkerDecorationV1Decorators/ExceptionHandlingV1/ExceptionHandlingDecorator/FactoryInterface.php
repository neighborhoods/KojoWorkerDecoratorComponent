<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface;

interface FactoryInterface
{
    public function create(): ExceptionHandlingDecoratorInterface;
}
