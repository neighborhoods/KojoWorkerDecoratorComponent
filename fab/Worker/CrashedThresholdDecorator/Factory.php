<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorInterface
    {
        return clone $this->getWorkerCrashedThresholdDecorator();
    }
}
