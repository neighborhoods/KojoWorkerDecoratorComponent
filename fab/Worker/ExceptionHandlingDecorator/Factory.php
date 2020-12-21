<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ExceptionHandlingDecoratorInterface
    {
        return clone $this->getWorkerExceptionHandlingDecorator();
    }
}
