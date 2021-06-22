<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

interface BuilderInterface
{
    public function build(): DecoratorInterface;

    public function setWorkerDecorationV1Worker(WorkerInterface $worker);
    public function setApiV1WorkerService(V1\Worker\ServiceInterface $apiV1WorkerService);
    public function setApiV1RDBMSConnectionService(V1\RDBMS\Connection\ServiceInterface $apiV1RDBMSConnectionService);
}
