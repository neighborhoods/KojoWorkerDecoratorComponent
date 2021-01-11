<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): RetriedThresholdDecoratorInterface
    {
        return clone $this->getWorkerRetriedThresholdDecorator();
    }
}
