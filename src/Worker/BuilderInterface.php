<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\FactoryInterface as DecoratorFactoryInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface BuilderInterface
{
    public function build(): WorkerInterface;

    public function setApiV1WorkerService(V1\Worker\ServiceInterface $apiV1WorkerService);
    public function setApiV1RDBMSConnectionService(V1\RDBMS\Connection\ServiceInterface $apiV1RDBMSConnectionService);

    public function addFactory(DecoratorFactoryInterface $decoratorFactory): BuilderInterface;
}
