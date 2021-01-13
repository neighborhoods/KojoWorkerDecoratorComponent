<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): UserlandPdoDecoratorInterface
    {
        return clone $this->getWorkerUserlandPdoDecorator();
    }
}
