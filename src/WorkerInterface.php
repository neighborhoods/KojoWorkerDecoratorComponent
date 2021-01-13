<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent;

use Neighborhoods\Kojo\Api\V1;

interface WorkerInterface
{
    public function work(): WorkerInterface;

    public function setApiV1WorkerService(V1\Worker\ServiceInterface $apiV1WorkerService);
    public function setApiV1RDBMSConnectionService(V1\RDBMS\Connection\ServiceInterface $apiV1RDBMSConnectionService);
}
