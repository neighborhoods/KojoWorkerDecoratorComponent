<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): CrashedThresholdDecoratorInterface;
}
