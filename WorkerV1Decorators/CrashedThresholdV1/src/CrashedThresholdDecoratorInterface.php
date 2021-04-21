<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\DecoratorInterface;

interface CrashedThresholdDecoratorInterface extends DecoratorInterface
{
    public function setThreshold(int $threshold): CrashedThresholdDecoratorInterface;
    public function setDelaySeconds(int $delaySeconds): CrashedThresholdDecoratorInterface;
}
