<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecoratorInterface;

interface FactoryInterface
{
    public function create(): UserlandPdoDecoratorInterface;
}
