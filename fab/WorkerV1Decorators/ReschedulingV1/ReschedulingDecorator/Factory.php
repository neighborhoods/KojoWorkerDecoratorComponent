<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ReschedulingDecoratorInterface
    {
        return clone $this->getWorkerV1DecoratorsReschedulingV1ReschedulingDecorator();
    }
}
