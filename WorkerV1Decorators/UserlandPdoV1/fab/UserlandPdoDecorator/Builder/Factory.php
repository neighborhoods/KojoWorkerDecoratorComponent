<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getUserlandPdoDecoratorBuilder();
    }
}
