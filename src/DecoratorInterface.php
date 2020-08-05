<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent;

use Neighborhoods\Kojo\Api\V1\RDBMS\Connection\ServiceInterface;

interface DecoratorInterface
{
    public function work(): void;
    public function getApiV1RDBMSConnectionService(): ServiceInterface;
    public function getApiV1WorkerService(): \Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;
}
