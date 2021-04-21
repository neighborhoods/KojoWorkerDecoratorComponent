<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): RetryThresholdDecoratorInterface;
}
