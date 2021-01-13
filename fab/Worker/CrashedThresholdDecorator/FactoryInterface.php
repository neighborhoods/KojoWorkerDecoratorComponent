<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecoratorInterface;

interface FactoryInterface
{
    public function create(): CrashedThresholdDecoratorInterface;
}
