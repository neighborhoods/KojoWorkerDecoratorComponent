<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder();
    }
}
