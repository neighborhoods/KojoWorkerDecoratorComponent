<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

interface ProxyInterface extends WorkerInterface
{
    public function setApiV1WorkerService(V1\Worker\ServiceInterface $apiV1WorkerService);
    public function setApiV1RDBMSConnectionService(V1\RDBMS\Connection\ServiceInterface $apiV1RDBMSConnectionService);
}
