<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): RetriedThresholdDecoratorInterface;
}
