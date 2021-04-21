<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): CrashedThresholdDecoratorInterface
    {
        return clone $this->getCrashedThresholdDecorator();
    }
}
