<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): UserlandPdoDecoratorInterface
    {
        return clone $this->getUserlandPdoDecorator();
    }
}
