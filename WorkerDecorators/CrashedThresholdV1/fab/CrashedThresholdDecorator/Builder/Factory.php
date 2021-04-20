<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getCrashedThresholdDecoratorBuilder();
    }
}
