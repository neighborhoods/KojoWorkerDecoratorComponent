<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecoratorInterface;

interface FactoryInterface
{
    public function create(): ExceptionHandlingDecoratorInterface;
}
