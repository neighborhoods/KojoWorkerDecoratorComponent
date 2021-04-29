<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder();
    }
}
