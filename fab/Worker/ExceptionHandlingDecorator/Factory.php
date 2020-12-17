<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorInterface
    {
        return clone $this->getWorkerExceptionHandlingDecorator();
    }
}
