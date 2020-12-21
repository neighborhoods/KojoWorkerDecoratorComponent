<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): CrashedThresholdDecoratorInterface
    {
        return clone $this->getWorkerCrashedThresholdDecorator();
    }
}
