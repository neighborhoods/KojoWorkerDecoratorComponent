<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecoratorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): RetryThresholdDecoratorInterface
    {
        return clone $this->getWorkerRetryThresholdDecorator();
    }
}
