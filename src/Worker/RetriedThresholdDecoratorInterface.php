<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

interface RetriedThresholdDecoratorInterface extends DecoratorInterface
{
    public function setThreshold(int $threshold): RetriedThresholdDecoratorInterface;
}
