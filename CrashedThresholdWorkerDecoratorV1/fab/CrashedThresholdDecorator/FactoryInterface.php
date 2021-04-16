<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\CrashedThresholdWorkerDecoratorV1\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\CrashedThresholdWorkerDecoratorV1\CrashedThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): CrashedThresholdDecoratorInterface;
}
