<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\Connection\ConnectionAwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class UserlandPdoDecorator implements UserlandPdoDecoratorInterface
{
    use ConnectionAwareTrait;
    use DecoratorTrait;

    public function work(): WorkerInterface
    {
        $this->getApiV1RDBMSConnectionService()->usePDO($this->getConnection());

        $this->runWorker();

        return $this;
    }
}
