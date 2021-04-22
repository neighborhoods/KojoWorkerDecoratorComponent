<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

interface BuilderInterface
{
    public function build(): WorkerInterface;

    public function setApiV1WorkerService(V1\Worker\ServiceInterface $apiV1WorkerService);
    public function setApiV1RDBMSConnectionService(V1\RDBMS\Connection\ServiceInterface $apiV1RDBMSConnectionService);

    public function setWorkerV1WorkerFactory(FactoryInterface $workerFactory);
    public function addDecoratorBuilderFactory(
        Decorator\Builder\FactoryInterface $decoratorBuilderFactory
    ): BuilderInterface;
}
