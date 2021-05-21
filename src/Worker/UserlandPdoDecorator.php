<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\Connection;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class UserlandPdoDecorator implements UserlandPdoDecoratorInterface
{
    use DecoratorTrait;
    use V1\RDBMS\Connection\Service\AwareTrait;
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
