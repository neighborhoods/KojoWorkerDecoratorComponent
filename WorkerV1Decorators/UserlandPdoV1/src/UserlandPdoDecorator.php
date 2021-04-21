<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Connection;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

class UserlandPdoDecorator implements UserlandPdoDecoratorInterface
{
    use Worker\DecoratorTrait;
    use Connection\PdoAwareTrait;

    public function work(): WorkerInterface
    {
        $this->getApiV1RDBMSConnectionService()->usePDO(
            $this->getPdo()
        );

        $this->runWorker();

        return $this;
    }
}
