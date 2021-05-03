<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ReschedulingDecoratorInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator();
    }
}
