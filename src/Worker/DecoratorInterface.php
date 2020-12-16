<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface DecoratorInterface extends WorkerInterface
{
    public function setWorker(WorkerInterface $Worker);
    public function setApiV1WorkerService(V1\Worker\ServiceInterface $apiV1WorkerService);
    public function setApiV1RDBMSConnectionService(V1\RDBMS\Connection\ServiceInterface $ApiV1RDBMSConnectionService);
}
