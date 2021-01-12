<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

interface RetryThresholdDecoratorInterface extends DecoratorInterface
{
    public function setThreshold(int $threshold): RetryThresholdDecoratorInterface;
}
