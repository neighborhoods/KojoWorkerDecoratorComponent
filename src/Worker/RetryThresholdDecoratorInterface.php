<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\DecoratorInterface;

interface RetryThresholdDecoratorInterface extends DecoratorInterface
{
    public function setThreshold(int $threshold): RetryThresholdDecoratorInterface;
}
