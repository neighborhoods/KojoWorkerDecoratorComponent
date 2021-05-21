<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApiV1;

use Neighborhoods\Kojo\Api\V1\RDBMS\Connection\Service;
use Neighborhoods\Kojo\Api\V1\RDBMS\Connection\ServiceInterface;
use PDO;

class RDBMSConnectionServiceDelegator implements ServiceInterface
{
    use Service\AwareTrait;

    public function usePDO(PDO $PDO): ServiceInterface
    {
        $this->getApiV1RDBMSConnectionService()->usePDO($PDO);
        return $this;
    }
}
