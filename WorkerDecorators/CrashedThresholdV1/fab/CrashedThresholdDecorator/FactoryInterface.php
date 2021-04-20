<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorators\CrashedThresholdV1\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): CrashedThresholdDecoratorInterface;
}
