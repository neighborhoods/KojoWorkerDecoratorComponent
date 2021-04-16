<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\CrashedThresholdWorkerDecoratorV1\CrashedThresholdDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getCrashedThresholdDecoratorBuilder();
    }
}
