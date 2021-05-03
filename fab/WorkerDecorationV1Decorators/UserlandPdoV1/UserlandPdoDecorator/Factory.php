<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): UserlandPdoDecoratorInterface
    {
        return clone $this->getWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator();
    }
}
