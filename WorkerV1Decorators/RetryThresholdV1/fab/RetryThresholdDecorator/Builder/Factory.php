<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getRetryThresholdDecoratorBuilder();
    }
}
