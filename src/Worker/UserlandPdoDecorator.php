<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\KojoWorkerDecoratorComponent\Connection;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class UserlandPdoDecorator implements UserlandPdoDecoratorInterface
{
    use DecoratorTrait;
    use Connection\AwareTrait;

    public function work(): WorkerInterface
    {
        $this->getApiV1RDBMSConnectionService()->usePDO(
            $this->getConnection()->getWrappedConnection()
        );

        $this->runWorker();

        return $this;
    }
}
