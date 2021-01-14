<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): RetryThresholdDecoratorInterface;
}
