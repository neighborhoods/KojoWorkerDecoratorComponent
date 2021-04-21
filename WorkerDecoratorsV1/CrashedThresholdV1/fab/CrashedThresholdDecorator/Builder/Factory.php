<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getCrashedThresholdDecoratorBuilder();
    }
}
