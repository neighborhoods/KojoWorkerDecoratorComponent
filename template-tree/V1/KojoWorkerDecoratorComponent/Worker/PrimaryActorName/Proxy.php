<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

class Proxy implements ProxyInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;

    private $container;

    public function work(): WorkerInterface
    {
        $worker = $this->getContainer()->getPrimaryActorNameBuilderFactory()
            ->create()
            ->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService())
            ->setApiV1WorkerService($this->getApiV1WorkerService())
            ->build();

        $worker->work();

        return $this;
    }

    protected function getContainer(): ContainerInterface
    {
        if (!isset($this->container)) {
            $this->container = new Container();
        }

        return $this->container;
    }
}
