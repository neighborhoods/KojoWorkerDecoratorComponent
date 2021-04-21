<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): CrashedThresholdDecoratorInterface
    {
        return clone $this->getCrashedThresholdDecorator();
    }
}
