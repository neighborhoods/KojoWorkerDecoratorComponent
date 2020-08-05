<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator;

use Neighborhoods\KojoWorkerDecoratorComponent\Connection\ConnectionAwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\DelegateServiceGetterTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\WorkerAwareTrait;

class UserlandPDO implements \Neighborhoods\KojoWorkerDecoratorComponent\DecoratorInterface
{
    use WorkerAwareTrait;
    use ConnectionAwareTrait;
    use DelegateServiceGetterTrait;

    public function work(): void
    {
        $this->updateKojoPDOConnection();
        \call_user_func([$this->getWorker(), $this->getWorkerMethod()]);
    }

    private function updateKojoPDOConnection(): void
    {
        $this->getApiV1RDBMSConnectionService()->usePDO($this->getConnection());
    }
}
