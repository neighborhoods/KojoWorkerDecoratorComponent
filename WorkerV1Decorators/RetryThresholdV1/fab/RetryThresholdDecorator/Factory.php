<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): RetryThresholdDecoratorInterface
    {
        return clone $this->getRetryThresholdDecorator();
    }
}
