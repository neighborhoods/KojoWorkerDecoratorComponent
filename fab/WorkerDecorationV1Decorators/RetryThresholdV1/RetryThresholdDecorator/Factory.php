<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): RetryThresholdDecoratorInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator();
    }
}
