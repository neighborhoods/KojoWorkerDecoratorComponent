<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWorkerReschedulingDecoratorBuilder();
    }
}
