<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\Connection\ConnectionAwareTrait;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class UserlandPdoDecorator implements UserlandPdoDecoratorInterface
{
    use DecoratorTrait;
    use ConnectionAwareTrait;

    public function work(): WorkerInterface
    {
        $this->getApiV1RDBMSConnectionService()->usePDO($this->getConnection());

        $this->runWorker();

        return $this;
    }
}
