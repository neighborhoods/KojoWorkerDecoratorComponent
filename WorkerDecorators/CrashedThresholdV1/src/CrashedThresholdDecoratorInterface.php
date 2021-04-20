<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorators\CrashedThresholdV1;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;

interface CrashedThresholdDecoratorInterface extends DecoratorInterface
{
    public function setThreshold(int $threshold): CrashedThresholdDecoratorInterface;
    public function setDelaySeconds(int $delaySeconds): CrashedThresholdDecoratorInterface;
}
