<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\CrashedThresholdWorkerDecoratorV1\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\CrashedThresholdWorkerDecoratorV1\CrashedThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): CrashedThresholdDecoratorInterface
    {
        return clone $this->getCrashedThresholdDecorator();
    }
}
