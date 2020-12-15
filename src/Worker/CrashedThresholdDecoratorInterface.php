<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

interface CrashedThresholdDecoratorInterface extends DecoratorInterface
{
    public function setThreshold(int $threshold): CrashedThresholdDecoratorInterface;
}
