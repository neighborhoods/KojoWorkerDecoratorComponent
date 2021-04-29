<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder();
    }
}
