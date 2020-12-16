<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\Kojo\Api\V1;

trait DecoratorTrait
{
    use AwareTrait;
    use V1\Worker\Service\AwareTrait;
    use V1\RDBMS\Connection\Service\AwareTrait;

    private function runWorker(): self
    {
        $worker = $this->getWorker();
        // Inject Worker Service
        if (method_exists($worker, 'setApiV1WorkerService')) {
            $worker->setApiV1WorkerService($this->getApiV1WorkerService());
        }
        // Inject RDBMS Connection Service
        if (method_exists($worker, 'setApiV1RDBMSConnectionService')) {
            $worker->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService());
        }

        // Run worker
        $worker->work();

        return $this;
    }
}
